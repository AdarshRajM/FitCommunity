<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserWorkout extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'video_path', 'category', 'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(UserWorkoutReview::class);
    }
}
