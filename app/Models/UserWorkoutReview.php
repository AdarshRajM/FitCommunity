<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserWorkoutReview extends Model
{
    protected $fillable = [
        'user_id', 'user_workout_id', 'review', 'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workout()
    {
        return $this->belongsTo(UserWorkout::class, 'user_workout_id');
    }
}
