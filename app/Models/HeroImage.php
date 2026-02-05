<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'status',
        'sort_order',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('uploads/hero/' . $this->image_path);
        }
        return asset('assets/img/hero-default.jpg');
    }
}
