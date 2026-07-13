<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author',
        'image',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Scope to get only published posts
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Get the route key for model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
