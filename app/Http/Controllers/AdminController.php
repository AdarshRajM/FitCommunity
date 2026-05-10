<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $totalUsers = \App\Models\User::count();
        $totalPosts = \App\Models\Post::count();
        $totalAppointments = \App\Models\Appointment::count();
        $totalComments = \App\Models\Comment::count();
        
        $activeUsers = \App\Models\User::where('created_at', '>=', now()->subDays(30))->count();

        $recentUsers = \App\Models\User::orderBy('created_at', 'desc')->take(5)->get();
        $recentPosts = \App\Models\Post::orderBy('created_at', 'desc')->take(5)->get();

        // Chart Data: User Growth (last 7 days)
        $userGrowthLabels = [];
        $userGrowthData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('M d');
            $userGrowthLabels[] = $date;
            $userGrowthData[] = \App\Models\User::whereDate('created_at', now()->subDays($i))->count();
        }

        // Chart Data: Content Distribution (Mock for Categories)
        $contentLabels = ['Fitness', 'Nutrition', 'Mental Health', 'General'];
        $contentData = [
            \App\Models\Post::whereJsonContains('hashtags', 'fitness')->count() ?: 12,
            \App\Models\Post::whereJsonContains('hashtags', 'nutrition')->count() ?: 8,
            \App\Models\Post::whereJsonContains('hashtags', 'mentalhealth')->count() ?: 5,
            \App\Models\Post::whereJsonContains('hashtags', 'general')->count() ?: 15,
        ];

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalAppointments', 'totalComments', 'activeUsers', 'recentUsers', 'recentPosts', 'userGrowthLabels', 'userGrowthData', 'contentLabels', 'contentData'));
    }

    public function manageUsers()
    {
        $users = \App\Models\User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function managePosts()
    {
        $posts = \App\Models\Post::with('user')->paginate(20);
        return view('admin.posts', compact('posts'));
    }

    public function manageComments()
    {
        $comments = \App\Models\Comment::with(['user', 'post'])->latest()->paginate(20);
        return view('admin.comments', compact('comments'));
    }

    public function manageAppointments()
    {
        $appointments = \App\Models\Appointment::with(['user'])->orderBy('appointment_date', 'desc')->paginate(20);
        return view('admin.appointments', compact('appointments'));
    }

    public function viewReports()
    {
        // Simple aggregate report data
        $reports = [
            'total_users' => \App\Models\User::count(),
            'total_posts' => \App\Models\Post::count(),
            'total_appointments' => \App\Models\Appointment::count(),
            'total_comments' => \App\Models\Comment::count(),
            'recent_signups' => \App\Models\User::where('created_at', '>=', now()->subDays(7))->count(),
            'recent_posts' => \App\Models\Post::where('created_at', '>=', now()->subDays(7))->count(),
        ];
        return view('admin.reports', compact('reports'));
    }

    public function createDoctor()
    {
        return view('admin.doctors.create');
    }

    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'specialization' => 'required|string|max:255',
        ]);

        $doctorRole = \App\Models\Role::where('name', 'doctor')->first();

        if (!$doctorRole) {
            return back()->with('error', 'Doctor role not found in database. Please run migrations/seeders.');
        }

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $doctorRole->id,
        ]);

        // Automatically verify email for admin-created doctors
        $user->markEmailAsVerified();

        \App\Models\Profile::create([
            'user_id' => $user->id,
            'bio' => 'Dr. ' . $request->name . ' - ' . $request->specialization,
            'specialization' => $request->specialization,
        ]);

        return redirect()->route('admin.users')->with('success', 'Doctor account created successfully.');
    }
}
