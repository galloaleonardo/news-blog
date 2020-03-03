<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class News extends Model
{
    protected $guarded = [];
    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

