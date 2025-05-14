<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    protected $fillable = ['name', 'artist_id', 'description', 'genre', 'year'];
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);

    }
}
