<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'nationality',
        'package_interest',
        'travel_date',
        'pax',
        'accommodation_preference',
        'budget',
        'notes',
        'source',
        'status',
        'assigned_to',
    ];
}
