<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'organization_id',
        'title',
        'slug',
        'poster',
        'prize_pool',
        'total_slots',
        'entry_type',
        'registration_status',
        'description',
        'about',
        'additional_images',

        // VERY IMPORTANT 👇
        'type',
        'is_featured',
        'featured_until',
        'priority',
        'is_visible',
        'is_scammed',
        'pp_pending',
    ];

    protected $casts = [
        'additional_images' => 'array',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
