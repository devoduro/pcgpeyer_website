<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Devotional;
use App\Support\DevotionNotifier;
use App\Support\DevotionService;
use App\Support\PushNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class DevotionalController extends Controller
{
    public function index(DevotionService $days, PushNotifier $push)
    {
        $devotionals = Devotional::withCount('completions')->orderByDesc('publish_date')->paginate(20);

        // Schedule overview: today and the next 7 days, so gaps are visible before they happen.
        $today = $days->now()->startOfDay();
        $week = Devotional::whereBetween('publish_date', [$today->toDateString(), $today->addDays(6)->toDateString()])
            ->get()->keyBy(fn ($d) => $d->publish_date->toDateString());
        $upcoming = collect(range(0, 6))->map(function ($i) use ($today, $week) {
            $date = $today->addDays($i);

            return ['date' => $date, 'devotional' => $week->get($date->toDateString())];
        });

        return view('dashboard.devotionals.index', [
            'devotionals' => $devotionals,
            'upcoming' => $upcoming,
            'todayDate' => $today->toDateString(),
            'pushReady' => $push->isConfigured(),
            'notifyFrom' => config('devotion.notify_from'),
        ]);
    }

    public function create(Request $request)
    {
        $devotional = new Devotional(['published' => true, 'notify' => true]);
        // "Add" links in the week overview pre-fill the date.
        if ($request->filled('date')) {
            $devotional->publish_date = $request->query('date');
        }

        return view('dashboard.devotionals.form', compact('devotional'));
    }

    public function store(Request $request)
    {
        Devotional::create($this->validated($request));

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional created.');
    }

    public function edit(Devotional $devotional)
    {
        return view('dashboard.devotionals.form', compact('devotional'));
    }

    public function update(Request $request, Devotional $devotional)
    {
        $devotional->update($this->validated($request, $devotional));

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional updated.');
    }

    public function destroy(Devotional $devotional)
    {
        // Completions are kept for members' history, so only unused devotionals can be deleted.
        if ($devotional->completions()->exists()) {
            return back()->with('error', 'This devotional has completions. Unpublish it instead of deleting.');
        }
        if ($devotional->thumbnail) {
            Storage::disk('public')->delete($devotional->thumbnail);
        }
        $devotional->delete();

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional deleted.');
    }

    public function togglePublish(Devotional $devotional)
    {
        $devotional->update(['published' => !$devotional->published]);

        return back()->with('success', 'Devotional status updated.');
    }

    /** "Send now" / "Send again": pushes this devotional to every app install straight away. */
    public function sendNotification(Devotional $devotional, DevotionNotifier $notifier)
    {
        if (! $devotional->published) {
            return back()->with('error', 'Publish the devotional before sending it.');
        }

        try {
            $notifier->send($devotional, force: true);
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', 'Notification not sent: ' . $e->getMessage());
        }

        return back()->with('success', "Notification sent to everyone with the app: \"{$notifier->title($devotional)}\".");
    }

    private function validated(Request $request, ?Devotional $current = null): array
    {
        $data = $request->validate([
            'publish_date' => ['required', 'date_format:Y-m-d', Rule::unique('devotionals', 'publish_date')->ignore($current?->id)],
            'title' => ['required', 'string', 'max:255'],
            'scripture_reference' => ['required', 'string', 'max:255'],
            'scripture_text' => ['nullable', 'string'],
            'reflection' => ['required', 'string'],
            'prayer' => ['nullable', 'string'],
            'question' => ['nullable', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'notification_title' => ['nullable', 'string', 'max:100'],
            'notification_body' => ['nullable', 'string', 'max:240'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);
        $data['published'] = $request->boolean('published');
        $data['notify'] = $request->boolean('notify');

        unset($data['thumbnail']);
        if ($request->hasFile('thumbnail')) {
            if ($current?->thumbnail) {
                Storage::disk('public')->delete($current->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('devotionals', 'public');
        } elseif ($request->boolean('remove_thumbnail') && $current?->thumbnail) {
            Storage::disk('public')->delete($current->thumbnail);
            $data['thumbnail'] = null;
        }

        return $data;
    }
}
