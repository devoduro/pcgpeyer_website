<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use HasFactory;

    protected $table = 'prayer_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'request',
        'category',
        'is_private',
        'is_answered',
        'admin_notes',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'is_answered' => 'boolean',
    ];

    /**
     * Scope to get public prayer requests
     */
    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }

    /**
     * Scope to get unanswered requests
     */
    public function scopeUnanswered($query)
    {
        return $query->where('is_answered', false);
    }
}
