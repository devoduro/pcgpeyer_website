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
    /** Public URL of the ministry photo, or a congregation photo when none has been uploaded. */
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/bantama/members_group.jpg');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
