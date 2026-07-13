<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'image',
        'category',
        'published',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'published' => 'boolean',
    ];

    /**
     * Scope to get published events
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Scope to get upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }
}
