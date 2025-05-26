<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    protected $fillable = ['name', 'artist_id', 'album_id', 'description', 'genre', 'year'];
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);

    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);

    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'artist' => $this->artist->name,
            'genre' => $this->genre,
            'album' => ($this->album ? $this->album->title : ''),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }
}
