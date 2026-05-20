<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

Route::get('/dashboard', [\App\Http\Controllers\HealthRecordController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard/health', [\App\Http\Controllers\HealthRecordController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('health.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Community Forum Routes
    Route::resource('community', \App\Http\Controllers\PostController::class);
    Route::post('/community/{post}/like', [\App\Http\Controllers\PostController::class, 'like'])->name('community.like');
    Route::post('/community/{post}/comment', [\App\Http\Controllers\PostController::class, 'comment'])->name('community.comment');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\PostController::class, 'deleteComment'])->name('comments.destroy');

    // Mental Health Hub
    Route::get('/meditation', function() {
        return view('meditation.index');
    })->name('meditation.index');

    // Recipes & Diet Plans
    Route::resource('recipes', \App\Http\Controllers\RecipeController::class);

    // Chat System
    Route::get('/chat/{user?}', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');

    // Appointments System
    Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [\App\Http\Controllers\AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/{appointment}/status', [\App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointments.status');

    // Nutrition AI System
    Route::get('/nutrition', [\App\Http\Controllers\NutritionController::class, 'index'])->name('nutrition.index');
    Route::post('/nutrition/analyze', [\App\Http\Controllers\NutritionController::class, 'analyze'])->name('nutrition.analyze');

    // Telemedicine
    Route::get('/telemedicine/room/{peer_id}', function($peer_id) {
        return view('telemedicine.room', ['peer_id' => $peer_id]);
    })->name('telemedicine.room');

    // Notifications & Settings
    Route::get('/notifications', function() { return view('notifications'); })->name('notifications');
    Route::get('/settings', function() { return view('settings'); })->name('settings');

    // Health History
    Route::get('/health/history', [\App\Http\Controllers\HealthRecordController::class, 'history'])->name('health.history');

    // Blogs
    Route::resource('blogs', \App\Http\Controllers\BlogController::class);

    // User Workouts & Reviews
    Route::get('/api/workouts', [\App\Http\Controllers\UserWorkoutController::class, 'index'])->name('workouts.api.index');
    Route::post('/api/workouts', [\App\Http\Controllers\UserWorkoutController::class, 'store'])->name('workouts.api.store');
    Route::post('/api/workouts/{id}/reviews', [\App\Http\Controllers\UserWorkoutController::class, 'storeReview'])->name('workouts.api.review');
    // Admin Panel
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin.users');
        Route::get('/admin/posts', [\App\Http\Controllers\AdminController::class, 'managePosts'])->name('admin.posts');
        Route::get('/admin/comments', [\App\Http\Controllers\AdminController::class, 'manageComments'])->name('admin.comments');
        Route::get('/admin/appointments', [\App\Http\Controllers\AdminController::class, 'manageAppointments'])->name('admin.appointments');
        Route::get('/admin/reports', [\App\Http\Controllers\AdminController::class, 'viewReports'])->name('admin.reports');
        Route::get('/admin/doctors/create', [\App\Http\Controllers\AdminController::class, 'createDoctor'])->name('admin.doctors.create');
        Route::post('/admin/doctors', [\App\Http\Controllers\AdminController::class, 'storeDoctor'])->name('admin.doctors.store');
    });

    // Doctor Portal
    Route::middleware(['role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', [\App\Http\Controllers\DoctorController::class, 'dashboard'])->name('doctor.dashboard');
        Route::post('/doctor/report', [\App\Http\Controllers\DoctorController::class, 'uploadReport'])->name('doctor.report.upload');
    });
});

// Public Static Pages
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// Workout Library and Report Analysis pages
Route::get('/workouts', function() {
    return view('workouts');
})->name('workouts.index');

Route::get('/reports/analysis', function() {
    return view('report_analysis');
})->name('reports.analysis');

// Global AI Chatbot Route (No auth required to use the chatbot on home page, but CSRF is required)
Route::post('/chatbot/message', [\App\Http\Controllers\ChatbotController::class, 'message'])->name('chatbot.message');
Route::post('/api/ai/chat', [\App\Http\Controllers\AIServiceController::class, 'handleChat'])->name('ai.chat');

// Real Doctor Directory API
Route::get('/api/doctors/directory', [\App\Http\Controllers\DoctorController::class, 'getDirectory']);
Route::post('/api/doctors/alert/{id}', [\App\Http\Controllers\DoctorController::class, 'sendEmergencyAlert']);
