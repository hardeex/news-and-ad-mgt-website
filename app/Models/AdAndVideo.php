<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAndVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'vertical_ad',
        'horizontal_ad',
        'video_upload',
        'video_link',
    ];
}
