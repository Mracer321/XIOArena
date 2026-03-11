<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'membership',
        'trust_status',
        'tournament_limit',
        'instagram',
        'discord',
        'youtube',
        'website',
    ];
    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }
}
