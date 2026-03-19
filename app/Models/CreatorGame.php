<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreatorGame extends Model
{
    protected $fillable = [
        'creator_id',
        'game_name'
    ];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
