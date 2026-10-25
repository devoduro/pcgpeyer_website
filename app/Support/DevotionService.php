<?php

namespace App\Support;

use App\Models\AppUser;
use App\Models\Devotional;
use App\Models\DevotionalCompletion;
use Carbon\CarbonImmutable;

/** All devotion rules live here so the API and the gate middleware agree. */
class DevotionService
{
    /** "Now" in the church timezone. */
    public function now(): CarbonImmutable
    {
        return CarbonImmutable::now(config('devotion.timezone'));
    }

    public function today(): string
    {
        return $this->now()->toDateString();
    }

    /** Today's published devotional, or null when none has been published. */
    public function todaysDevotional(): ?Devotional
    {
        return Devotional::where('published', true)->whereDate('publish_date', $this->today())->first();
    }

    public function hasCompleted(AppUser $user, Devotional $devotional): bool
    {
        return DevotionalCompletion::where('app_user_id', $user->id)
            ->where('devotional_id', $devotional->id)->exists();
    }

    /** Is the user subject to the lock at all (church policy or personal choice)? */
    public function lockApplies(AppUser $user): bool
    {
        return match (config('devotion.policy')) {
            'required' => true,
            'optional' => (bool) $user->devotion_first,
            default => false,
        };
    }

    /**
     * Content is blocked only when the lock applies, a devotional exists for today
     * (we never lock people behind content that was not published) and it is not completed.
     */
    public function isLocked(AppUser $user): bool
    {
        if (!$this->lockApplies($user)) {
            return false;
        }
        $today = $this->todaysDevotional();

        return $today !== null && !$this->hasCompleted($user, $today);
    }

    /** Consecutive days with a completion, ending today (or yesterday if today is not done yet). */
    public function streak(AppUser $user): int
    {
        $dates = DevotionalCompletion::where('app_user_id', $user->id)
            ->orderByDesc('completed_on')->pluck('completed_on')
            ->map(fn ($d) => $d->toDateString())->unique()->values();

        $day = $this->now()->startOfDay();
        if (!$dates->contains($day->toDateString())) {
            $day = $day->subDay();
        }

        $streak = 0;
        while ($dates->contains($day->toDateString())) {
            $streak++;
            $day = $day->subDay();
        }

        return $streak;
    }
}
