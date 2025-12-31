<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafariPackage extends Model
{
    protected $fillable = [
        'name',
        'badge_label',
        'duration_label',
        'short_description',
        'features_text',
        'price_amount',
        'price_suffix',
        'image_path',
        'status',
        'sort_order',
    ];

    public $timestamps = false;
}
