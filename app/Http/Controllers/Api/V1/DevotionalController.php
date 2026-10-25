<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Devotional;
use App\Models\DevotionalCompletion;
use App\Support\DevotionService;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevotionalController extends Controller
{
    public function __construct(private DevotionService $devotions)
    {
    }

    /** Lock state for the app shell. Cheap enough to call on every launch and resume. */
    public function status(Request $request): JsonResponse
    {
        $user = $request->user();
        $today = $this->devotions->todaysDevotional();

        return response()->json([
            'date' => $this->devotions->today(),
            'timezone' => config('devotion.timezone'),
            'policy' => config('devotion.policy'),
            'devotion_first' => (bool) $user->devotion_first,
            'has_devotional_today' => (bool) $today,
            'completed_today' => $today ? $this->devotions->hasCompleted($user, $today) : false,
            'locked' => $this->devotions->isLocked($user),
            'locked_modules' => config('devotion.locked_modules'),
            'streak' => $this->devotions->streak($user),
        ]);
    }

    public function today(Request $request): JsonResponse
    {
        $devotional = $this->devotions->todaysDevotional();
        if (!$devotional) {
            return response()->json(['message' => 'No devotional has been published for today.'], 404);
        }

        return $this->show($request, $devotional);
    }

    public function showById(Request $request, Devotional $devotional): JsonResponse
    {
        // Drafts and future devotionals are never exposed.
        if (!$devotional->published || $devotional->publish_date->toDateString() > $this->devotions->today()) {
            abort(404);
        }

        return $this->show($request, $devotional);
    }

    /** Fetching a devotional records the first-open time that the minimum reading time is measured from. */
    private function show(Request $request, Devotional $devotional): JsonResponse
    {
        $user = $request->user();

        DB::table('devotional_reads')->insertOrIgnore([
            'app_user_id' => $user->id,
            'devotional_id' => $devotional->id,
            'opened_at' => now(),
        ]);

        return response()->json([
            'devotional' => [
                'id' => $devotional->id,
                'date' => $devotional->publish_date->toDateString(),
                'title' => $devotional->title,
                'scripture_reference' => $devotional->scripture_reference,
                'scripture_text' => $devotional->scripture_text,
                'reflection' => $devotional->reflection,
                'prayer' => $devotional->prayer,
                'question' => $devotional->question,
                'author' => $devotional->author,
                'thumbnail' => $devotional->thumbnail,
                'is_today' => $devotional->publish_date->toDateString() === $this->devotions->today(),
            ],
            'completed' => $this->devotions->hasCompleted($user, $devotional),
            'min_read_seconds' => config('devotion.min_read_seconds'),
            'requires_answer' => config('devotion.require_reflection') && filled($devotional->question),
        ]);
    }

    public function complete(Request $request, Devotional $devotional): JsonResponse
    {
        $user = $request->user();

        if (!$devotional->published || $devotional->publish_date->toDateString() !== $this->devotions->today()) {
            return response()->json(['message' => "Only today's devotional can be completed."], 422);
        }

        if ($this->devotions->hasCompleted($user, $devotional)) {
            return response()->json(['completed' => true, 'streak' => $this->devotions->streak($user)]);
        }

        $requiresAnswer = config('devotion.require_reflection') && filled($devotional->question);
        $data = $request->validate([
            'answer' => [$requiresAnswer ? 'required' : 'nullable', 'string', 'max:2000'],
        ]);

        $openedAt = DB::table('devotional_reads')
            ->where(['app_user_id' => $user->id, 'devotional_id' => $devotional->id])->value('opened_at');
        if (!$openedAt) {
            return response()->json(['message' => 'Open the devotional before completing it.'], 422);
        }

        $elapsed = CarbonImmutable::parse($openedAt)->diffInSeconds(now(), false);
        $wait = config('devotion.min_read_seconds') - $elapsed;
        if ($wait > 0) {
            return response()->json([
                'message' => 'Please take a little more time with the devotional.',
                'retry_after_seconds' => (int) ceil($wait),
            ], 422);
        }

        DevotionalCompletion::create([
            'app_user_id' => $user->id,
            'devotional_id' => $devotional->id,
            'completed_on' => $this->devotions->today(),
            'answer' => $data['answer'] ?? null,
            'completed_at' => now(),
        ]);

        return response()->json(['completed' => true, 'streak' => $this->devotions->streak($user)], 201);
    }

    /** Completion calendar for a month (?month=YYYY-MM, defaults to the current month). */
    public function history(Request $request): JsonResponse
    {
        $request->validate(['month' => ['nullable', 'date_format:Y-m']]);
        $month = $request->query('month', $this->devotions->now()->format('Y-m'));
        $start = CarbonImmutable::createFromFormat('Y-m-d', $month . '-01')->startOfMonth();

        $days = DevotionalCompletion::where('app_user_id', $request->user()->id)
            ->whereBetween('completed_on', [$start->toDateString(), $start->endOfMonth()->toDateString()])
            ->orderBy('completed_on')->pluck('completed_on')
            ->map(fn ($d) => $d->toDateString())->values();

        return response()->json([
            'month' => $month,
            'completed_days' => $days,
            'streak' => $this->devotions->streak($request->user()),
        ]);
    }

    public function setDevotionFirst(Request $request): JsonResponse
    {
        $data = $request->validate(['enabled' => ['required', 'boolean']]);

        if (config('devotion.policy') !== 'optional') {
            return response()->json(['message' => 'Devotion-first mode is controlled by the church.'], 409);
        }

        $request->user()->forceFill(['devotion_first' => $data['enabled']])->save();

        return $this->status($request);
    }
}
