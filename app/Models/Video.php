<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_type',
        'video_url',
        'video_file',
        'thumbnail',
        'duration',
        'featured',
        'published',
        'publish_date',
        'category',
        'views'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published' => 'boolean',
        'publish_date' => 'date',
        'views' => 'integer'
    ];

    /**
     * Get the video embed URL based on the video type
     *
     * @return string|null
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->video_type === 'youtube') {
            // Extract YouTube video ID from URL
            $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
            if (preg_match($pattern, $this->video_url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        } elseif ($this->video_type === 'vimeo') {
            // Extract Vimeo video ID from URL
            $pattern = '/(?:vimeo\.com\/)(\d+)/i';
            if (preg_match($pattern, $this->video_url, $matches)) {
                return 'https://player.vimeo.com/video/' . $matches[1];
            }
        } elseif ($this->video_type === 'upload' && $this->video_file) {
            return asset('storage/' . $this->video_file);
        }
        
        return null;
    }

    /**
     * Get the thumbnail URL
     *
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        // Get YouTube thumbnail if it's a YouTube video
        if ($this->video_type === 'youtube' && $this->video_url) {
            $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
            if (preg_match($pattern, $this->video_url, $matches)) {
                return 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
            }
        }
        
        // Default thumbnail if none is set
        return asset('images/default-video-thumbnail.jpg');
    }
    
    /**
     * Get YouTube video ID
     *
     * @return string|null
     */
    public function getYoutubeIdAttribute()
    {
        if ($this->video_type === 'youtube' && $this->video_url) {
            $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
            if (preg_match($pattern, $this->video_url, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Increment the view count
     *
     * @return void
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Scope a query to only include published videos
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', true)
                     ->where(function($q) {
                         $q->whereNull('publish_date')
                           ->orWhere('publish_date', '<=', now());
                     });
    }

    /**
     * Scope a query to only include featured videos
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
