<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasFactory;

    protected $table = 'ministries';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'ministry_category',
        'age_range',
        'description',
        'content',
        'image',
        'leader',
        'leader_phone',
        'leader_picture',
        'contact_email',
        'meeting_schedule',
        'location',
        'featured',
        'active',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Scope to get active ministries
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Get the route key for model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
