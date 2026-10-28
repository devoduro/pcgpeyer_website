<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LeadershipYear;

class Leadership extends Model
{
    use HasFactory;

    protected $table = 'leadership';

    protected $fillable = [
        'name',
        'title_text',
        'title_id',
        'bio',
        'image',
        'email',
        'phone',
        'year',
        'year_end',
        'served_from',
        'served_to',
        'display_order',
        'active',
        'is_current',
    ];

    protected $casts = [
        'year' => 'integer',
        'year_end' => 'integer',
        'served_from' => 'date',
        'served_to' => 'date',
        'active' => 'boolean',
        'is_current' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship to title
     */
    public function titleRelation()
    {
        return $this->belongsTo(LeadershipTitle::class, 'title_id');
    }

    /**
     * Relationship to year range (by start year)
     */
    public function yearRelation()
    {
        return $this->belongsTo(LeadershipYear::class, 'year', 'year');
    }

    /**
     * Get formatted period for this leadership member: their own tenure when recorded
     * ("Apr 1968 – Sep 1970", "1978–1996"), otherwise the session term they belong to.
     */
    public function getYearRangeAttribute()
    {
        if ($this->served_from) {
            $to = $this->served_to ? $this->served_to->format('M Y') : ($this->is_current ? 'Present' : null);

            return $this->served_from->format('M Y') . ($to ? ' – ' . $to : '');
        }

        if ($this->year_end) {
            return $this->year_end === $this->year ? (string) $this->year : $this->year . '–' . $this->year_end;
        }

        return $this->yearRelation?->yearRange ?? (string) $this->year;
    }

    /** Last year of service: the recorded end, else the start year (single-year or open records). */
    public function getEndYearAttribute(): int
    {
        return $this->year_end ?? $this->served_to?->year ?? $this->year;
    }

    /** Whether this leader was serving at any point between two years (inclusive). */
    public function servedBetween(int $from, int $to): bool
    {
        return $this->year <= $to && $this->endYear >= $from;
    }

    /**
     * Get the display title
     */
    public function getDisplayTitleAttribute()
    {
        return $this->titleRelation?->title ?? $this->title_text;
    }

    /**
     * Get a human-readable service duration (e.g. "4 years") based on the linked year range
     */
    public function getServiceDurationAttribute()
    {
        if ($this->served_from && $this->served_to) {
            $diff = $this->served_from->diff($this->served_to);
            $parts = array_filter([
                $diff->y ? $diff->y . ' ' . \Illuminate\Support\Str::plural('year', $diff->y) : null,
                $diff->m ? $diff->m . ' ' . \Illuminate\Support\Str::plural('month', $diff->m) : null,
            ]);

            return $parts ? implode(', ', $parts) : null;
        }

        if ($this->year_end) {
            $years = $this->year_end - $this->year;

            return $years > 0 ? $years . ' ' . \Illuminate\Support\Str::plural('year', $years) : null;
        }

        $range = $this->yearRelation;

        if (!$range || !$range->year_end) {
            return null;
        }

        $years = $range->year_end - $range->year;

        return $years > 0 ? $years . ' ' . \Illuminate\Support\Str::plural('year', $years) : null;
    }

    /**
     * Get only active leadership members
     */
    /** Tabs on the "Past ministers" page and in the app, in display order. */
    public const MINISTER_CATEGORIES = ['Ministers-in-Charge', 'Associate Ministers', 'Catechists', 'Presbyter Sessions'];

    /** Which past-ministers category a title belongs to (null when it fits none). */
    public static function ministerCategory(?string $title): ?string
    {
        $t = strtolower($title ?? '');
        if (str_contains($t, 'associate') || str_contains($t, 'second minister')) {
            return 'Associate Ministers';
        }
        if (str_contains($t, 'minister')) {
            return 'Ministers-in-Charge';
        }
        if (str_contains($t, 'catechist')) {
            return 'Catechists';
        }
        if (str_contains($t, 'session') || str_contains($t, 'presbyter') || str_contains($t, 'treasurer') || str_contains($t, 'youth rep')) {
            return 'Presbyter Sessions';
        }

        return null;
    }

    /**
     * Leaders listed by session term on the Church Leadership page: anyone currently serving, plus
     * term-based records. Past leaders with their own tenure dates appear only under Past Leaders.
     */
    public function scopeTermRoster($query)
    {
        return $query->where(function ($q) {
            $q->where('is_current', true)
              ->orWhere(fn ($q) => $q->whereNull('year_end')->whereNull('served_from'));
        });
    }

    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('year', 'desc')->orderBy('display_order', 'asc');
    }

    /**
     * Get all leadership ordered by year and display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('year', 'desc')->orderBy('display_order', 'asc');
    }

    /**
     * Get leadership for current year
     */
    public function scopeCurrentYear($query)
    {
        return $query->where('year', now()->year)->where('active', true)->orderBy('display_order', 'asc');
    }
}
