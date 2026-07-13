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
        'display_order',
        'active',
        'is_current',
    ];

    protected $casts = [
        'year' => 'integer',
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
     * Get formatted year range for this leadership member
     */
    public function getYearRangeAttribute()
    {
        return $this->yearRelation?->yearRange ?? (string) $this->year;
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
