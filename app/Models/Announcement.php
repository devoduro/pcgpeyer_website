<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'message',
        'type',
        'link_url',
        'link_text',
        'starts_at',
        'expires_at',
        'pinned',
        'published',
        'display_order',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'pinned' => 'boolean',
        'published' => 'boolean',
    ];

    /**
     * Published, currently within its start/expiry window, newest pinned first.
     */
    public function scopeActive($query)
    {
        return $query->where('published', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->orderByDesc('pinned')
            ->orderBy('display_order')
            ->orderByDesc('created_at');
    }
}
