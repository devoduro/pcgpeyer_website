<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTitle extends Model
{
    use HasFactory;

    protected $table = 'leadership_titles';

    protected $fillable = [
        'title',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get all active titles
     */
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('title', 'asc');
    }

    /**
     * Get all titles ordered alphabetically
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('title', 'asc');
    }

    /**
     * Relationship to leadership members
     */
    public function leaders()
    {
        return $this->hasMany(Leadership::class, 'title_id', 'id');
    }
}
