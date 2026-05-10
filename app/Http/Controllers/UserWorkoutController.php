<?php

namespace App\Http\Controllers;

use App\Models\UserWorkout;
use App\Models\UserWorkoutReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWorkoutController extends Controller
{
    public function index()
    {
        $workouts = UserWorkout::with('user', 'reviews.user')->latest()->get();
        return response()->json($workouts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:home,gym,other',
            'duration' => 'nullable|string',
            'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:51200',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/workouts/videos');
            $videoPath = basename($videoPath);
        }

        $workout = UserWorkout::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'duration' => $request->duration,
            'video_path' => $videoPath,
        ]);

        return response()->json(['message' => 'Workout uploaded successfully', 'workout' => $workout]);
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = UserWorkoutReview::create([
            'user_id' => Auth::id(),
            'user_workout_id' => $id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => 'Review added successfully', 'review' => $review->load('user')]);
    }
}
