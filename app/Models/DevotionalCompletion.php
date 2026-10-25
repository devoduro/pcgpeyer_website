<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevotionalCompletion extends Model
{
    public $timestamps = false;

    protected $fillable = ['app_user_id', 'devotional_id', 'completed_on', 'answer', 'completed_at'];

    protected $casts = [
        'completed_on' => 'date:Y-m-d',
        'completed_at' => 'datetime',
    ];

    public function devotional()
    {
        return $this->belongsTo(Devotional::class);
    }
}
