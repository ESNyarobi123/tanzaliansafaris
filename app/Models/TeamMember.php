<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'role',
        'experience_years',
        'bio',
        'image_path',
        'email',
        'phone',
        'specialties',
        'languages',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'specialties' => 'array',
        'languages' => 'array',
        'experience_years' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')
                     ->orderBy('id', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('assets/img/default-avatar.jpg');
    }

    public function getSpecialtiesListAttribute()
    {
        return $this->specialties ? implode(', ', $this->specialties) : '';
    }

    public function getLanguagesListAttribute()
    {
        return $this->languages ? implode(', ', $this->languages) : '';
    }
}
