<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** One executive of a fellowship, guild or singing group (see Ministry::leaders). */
class GroupLeader extends Model
{
    protected $fillable = [
        'ministry_id',
        'name',
        'position',
        'photo',
        'display_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    /** Public URL of the leader's photo, or the generic avatar when none has been uploaded. */
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/avatar-placeholder.png');
    }
}
