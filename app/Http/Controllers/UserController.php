<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\HealthRecord;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get today's health record
        $todayRecord = HealthRecord::where('user_id', $user->id)
            ->where('record_date', today())
            ->first();

        // Get recent posts
        $recentPosts = Post::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Get upcoming appointments
        $upcomingAppointments = Appointment::where('user_id', $user->id)
            ->where('appointment_date', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_date')
            ->take(3)
            ->get();

        // Get unread notifications
        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->latest()
            ->take(5)
            ->get();

        // Get weekly health stats
        $weeklyStats = HealthRecord::where('user_id', $user->id)
            ->whereBetween('record_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        return view('dashboard', compact('todayRecord', 'recentPosts', 'upcomingAppointments', 'notifications', 'weeklyStats'));
    }

    /**
     * Show the user profile.
     */
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('profile.show', compact('user', 'profile'));
    }

    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'height' => ['nullable', 'numeric', 'min:0', 'max:300'],
            'weight' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'emergency_contact' => ['nullable', 'string', 'max:100'],
            'emergency_phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        $profile = $user->profile;
        $profile->update($request->except(['name', 'email', 'password']));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user avatar.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        $path = $request->file('avatar')->store('public/avatars');
        $filename = basename($path);

        $user->update(['avatar' => $filename]);

        return back()->with('success', 'Avatar updated successfully!');
    }

    /**
     * Show notifications.
     */
    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark notification as read.
     */
    public function markNotificationAsRead(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->update(['is_read' => true]);
        }

        if ($notification->link) {
            return redirect($notification->link);
        }

        return back();
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back();
    }
}