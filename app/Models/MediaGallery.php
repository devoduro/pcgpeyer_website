<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaGallery extends Model
{
    use HasFactory;

    protected $table = 'media_gallery';

    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'video_url',
        'thumbnail',
        'category',
        'event_date',
        'order',
        'featured',
    ];

    protected $casts = [
        'event_date' => 'date',
        'order' => 'integer',
        'featured' => 'boolean',
    ];

    /**
     * Scope to get featured items
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to get items by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
