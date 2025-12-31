<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'reference',
        'full_name',
        'email',
        'phone',
        'country',
        'package_id',
        'accommodation',
        'start_date',
        'nights',
        'adults',
        'children',
        'payment_method',
        'payment_data',
        'message',
        'status',
    ];

    public $timestamps = false; // The table doesn't have updated_at

    public function package()
    {
        return $this->belongsTo(SafariPackage::class, 'package_id');
    }
}
