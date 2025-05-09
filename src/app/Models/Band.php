<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Band extends Model
{
    protected $fillable = ['name', 'member_id', 'description', 'genre', 'formed_year'];
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);

    }
}
