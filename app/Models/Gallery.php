<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'status',
    ];

    public $timestamps = false;

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute(): string
    {
        // If image_path is already a full URL, return it
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        // If image_path starts with 'storage/', use asset()
        if (str_starts_with($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }

        // If image_path starts with 'gallery/' or other local paths
        if ($this->image_path) {
            // Check if file exists in public storage
            if (Storage::disk('public')->exists($this->image_path)) {
                return Storage::disk('public')->url($this->image_path);
            }
            return asset('storage/' . $this->image_path);
        }

        // Fallback image
        return 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }
}
