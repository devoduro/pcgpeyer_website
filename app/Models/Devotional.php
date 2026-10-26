<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devotional extends Model
{
    protected $fillable = [
        'publish_date', 'title', 'scripture_reference', 'scripture_text', 'reflection',
        'prayer', 'question', 'author', 'thumbnail', 'published',
        'notify', 'notification_title', 'notification_body',
    ];

    protected $casts = [
        'publish_date' => 'date:Y-m-d',
        'published' => 'boolean',
        'notify' => 'boolean',
        'notified_at' => 'datetime',
    ];

    public function completions()
    {
        return $this->hasMany(DevotionalCompletion::class);
    }
}
