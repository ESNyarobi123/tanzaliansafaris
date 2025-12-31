<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'destination',
        'duration_days',
        'duration_nights',
        'price',
        'min_pax',
        'max_pax',
        'highlights',
        'inclusions',
        'exclusions',
        'itinerary',
        'featured_image',
        'gallery',
        'difficulty_level',
        'best_season',
        'featured',
        'display_order',
        'status',
        'created_by',
    ];
}
