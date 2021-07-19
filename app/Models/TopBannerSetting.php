<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopBannerSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'keep_on_top_when_scrolling'
    ];
}
