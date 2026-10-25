<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HymnVerse extends Model
{
    protected $fillable = [
        'hymn_id', 'language', 'position', 'label', 'text', 'raw_text', 'source_font', 'flags', 'review_status',
    ];

    public function hymn()
    {
        return $this->belongsTo(Hymn::class);
    }
}
