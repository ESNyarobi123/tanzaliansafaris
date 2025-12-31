<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $table = 'page_content';

    protected $fillable = [
        'page_slug',
        'section_key',
        'content',
    ];

    const CREATED_AT = null; // It only has updated_at
}
