<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BroadcastHistory extends Model
{
    protected $fillable = ['subject', 'message', 'target', 'sent_count', 'failed_count'];
}
