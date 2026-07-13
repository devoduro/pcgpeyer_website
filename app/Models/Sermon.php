<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $table = 'sermons';

    protected $fillable = [
        'title',
        'preacher',
        'scripture_reference',
        'description',
        'sermon_date',
        'audio_url',
        'video_url',
        'thumbnail',
        'series',
        'featured',
    ];

    protected $casts = [
        'sermon_date' => 'date',
        'featured' => 'boolean',
    ];

    /**
     * Scope to get featured sermons
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
