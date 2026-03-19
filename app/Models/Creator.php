<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Creator extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'profile_image',
        'bio',
        'youtube',
        'instagram',
        'discord',
        'contact_email',
        'contact_phone',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($creator) {

            if (empty($creator->slug)) {
                $slug = Str::slug($creator->name);
                $original = $slug;
                $count = 1;

                // UNIQUE SLUG FIX
                while (self::where('slug', $slug)->where('id', '!=', $creator->id)->exists()) {
                    $slug = $original . '-' . $count++;
                }

                $creator->slug = $slug;
            }
        });
    }

    public function games()
    {
        return $this->hasMany(CreatorGame::class);
    }
}
