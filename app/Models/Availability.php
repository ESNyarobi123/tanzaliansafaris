<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Availability extends Model
{
    protected $fillable = [
        'package_id',
        'date',
        'status',
        'spots_total',
        'spots_booked',
        'spots_remaining',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(SafariPackage::class);
    }

    /**
     * Get availability status color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'available' => '#10b981', // green
            'booked' => '#ef4444',    // red
            'limited' => '#f59e0b',   // amber
            'unavailable' => '#6b7280', // gray
            default => '#10b981',
        };
    }

    /**
     * Get availability status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'available' => 'Available',
            'booked' => 'Fully Booked',
            'limited' => 'Limited Spots',
            'unavailable' => 'Unavailable',
            default => 'Available',
        };
    }

    /**
     * Check if date is available
     */
    public function getIsAvailableAttribute(): bool
    {
        return in_array($this->status, ['available', 'limited']) && $this->spots_remaining > 0;
    }

    /**
     * Scope for available dates
     */
    public function scopeAvailable($query)
    {
        return $query->whereIn('status', ['available', 'limited'])
                     ->where('spots_remaining', '>', 0)
                     ->where('date', '>=', Carbon::today());
    }

    /**
     * Scope for date range
     */
    public function scopeForDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope for specific package
     */
    public function scopeForPackage($query, $packageId)
    {
        return $query->where('package_id', $packageId);
    }

    /**
     * Auto-update spots remaining
     */
    protected static function booted()
    {
        static::saving(function ($availability) {
            $availability->spots_remaining = $availability->spots_total - $availability->spots_booked;
            
            // Auto-update status based on spots
            if ($availability->spots_remaining <= 0) {
                $availability->status = 'booked';
            } elseif ($availability->spots_remaining <= 2) {
                $availability->status = 'limited';
            } elseif ($availability->status === 'booked' && $availability->spots_remaining > 0) {
                $availability->status = 'limited';
            }
        });
    }
}
