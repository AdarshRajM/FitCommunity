<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\SoftDeletes;

use MongoDB\Laravel\Eloquent\Model;

class UserWorkout extends Model
{
    use SoftDeletes;
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
