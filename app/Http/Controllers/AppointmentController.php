<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->orWhere('doctor_id', Auth::id())
            ->orderBy('appointment_date', 'asc')
            ->get();
            
        $doctors = User::whereIn('role', ['doctor', 'trainer'])->get();

        return view('appointments.index', compact('appointments', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:now',
            'duration' => 'required|integer|in:30,60,90',
            'notes' => 'nullable|string',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'title' => $request->title,
            'appointment_date' => $request->appointment_date,
            'duration' => $request->duration,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! Waiting for confirmation.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        // Only the doctor can confirm/complete/cancel
        if (Auth::id() !== $appointment->doctor_id && Auth::id() !== $appointment->user_id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Appointment status updated.');
    }
}
