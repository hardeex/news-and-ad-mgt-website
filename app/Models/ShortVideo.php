<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortVideo extends Model
{
    protected $fillable = [
        'title', 'description', 'video_path', 'likes', 'views', 'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // Set default value for user_id before creating a new ShortVideo
        static::creating(function ($shortVideo) {
            // Check if user_id is not already set
            if (!$shortVideo->user_id) {
                // Assign a default user_id here
                $shortVideo->user_id = 1;
            }
        });
    }

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
