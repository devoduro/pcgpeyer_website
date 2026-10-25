<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hymn extends Model
{
    public const LANGUAGES = ['ga' => 'Ga', 'tw' => 'Twi', 'en' => 'English'];

    protected $fillable = ['number', 'author', 'source_file', 'status', 'import_notes', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];

    public function verses()
    {
        return $this->hasMany(HymnVerse::class)->orderBy('position')->orderBy('id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /** A hymn can be published only when every verse has been reviewed. */
    public function pendingVerseCount(): int
    {
        return $this->verses()->where('review_status', '!=', 'approved')->count();
    }
}
