<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipYear extends Model
{
    use HasFactory;

    protected $table = 'leadership_years';

    protected $fillable = [
        'year',
        'year_end',
        'description',
        'active',
    ];

    protected $casts = [
        'year' => 'integer',
        'year_end' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * Get all active years ordered by newest first
     */
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('year', 'desc');
    }

    /**
     * Get all years ordered by newest first
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('year', 'desc');
    }

    /**
     * Relationship to leadership members
     */
    public function leaders()
    {
        return $this->hasMany(Leadership::class, 'year', 'year');
    }

    /**
     * Get the formatted year range
     */
    public function getYearRangeAttribute()
    {
        if ($this->year_end && $this->year_end !== $this->year) {
            return $this->year . '-' . $this->year_end;
        }
        return (string)$this->year;
    }
}
