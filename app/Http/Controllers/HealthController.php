<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HealthController extends Controller
{
    /**
     * Show the health tracking dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get today's record
        $todayRecord = HealthRecord::where('user_id', $user->id)
            ->where('record_date', today())
            ->first();

        // Get weekly records
        $weeklyRecords = HealthRecord::where('user_id', $user->id)
            ->whereBetween('record_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('record_date')
            ->get();

        // Get monthly records
        $monthlyRecords = HealthRecord::where('user_id', $user->id)
            ->whereBetween('record_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->orderBy('record_date')
            ->get();

        // Get profile for BMI calculation
        $profile = $user->profile;

        return view('health.index', compact('todayRecord', 'weeklyRecords', 'monthlyRecords', 'profile'));
    }

    /**
     * Show the form for creating a new health record.
     */
    public function create()
    {
        return view('health.create');
    }

    /**
     * Store a newly created health record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'record_date' => ['required', 'date', 'before_or_equal:today'],
            'steps' => ['required', 'integer', 'min:0'],
            'calories_burned' => ['required', 'numeric', 'min:0'],
            'water_intake' => ['required', 'numeric', 'min:0'],
            'sleep_hours' => ['required', 'integer', 'min:0', 'max:24'],
            'weight' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'heart_rate' => ['nullable', 'integer', 'min:0', 'max:300'],
            'blood_pressure_systolic' => ['nullable', 'integer', 'min:0', 'max:300'],
            'blood_pressure_diastolic' => ['nullable', 'integer', 'min:0', 'max:200'],
            'mood' => ['nullable', 'in:happy,neutral,sad,stressed,energetic'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = Auth::user();

        // Check if record exists for this date
        $existingRecord = HealthRecord::where('user_id', $user->id)
            ->where('record_date', $request->record_date)
            ->first();

        if ($existingRecord) {
            $existingRecord->update($request->all());
            return redirect()->route('health.index')->with('success', 'Health record updated successfully!');
        }

        HealthRecord::create(array_merge($request->all(), ['user_id' => $user->id]));

        // Update profile weight if provided
        if ($request->weight) {
            $profile = $user->profile;
            if ($profile) {
                $profile->update(['weight' => $request->weight]);
            }
        }

        return redirect()->route('health.index')->with('success', 'Health record created successfully!');
    }

    /**
     * Show the form for editing a health record.
     */
    public function edit(HealthRecord $healthRecord)
    {
        $this->authorize('update', $healthRecord);

        return view('health.edit', compact('healthRecord'));
    }

    /**
     * Update the specified health record.
     */
    public function update(Request $request, HealthRecord $healthRecord)
    {
        $this->authorize('update', $healthRecord);

        $request->validate([
            'record_date' => ['required', 'date'],
            'steps' => ['required', 'integer', 'min:0'],
            'calories_burned' => ['required', 'numeric', 'min:0'],
            'water_intake' => ['required', 'numeric', 'min:0'],
            'sleep_hours' => ['required', 'integer', 'min:0', 'max:24'],
            'weight' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'heart_rate' => ['nullable', 'integer', 'min:0', 'max:300'],
            'blood_pressure_systolic' => ['nullable', 'integer', 'min:0', 'max:300'],
            'blood_pressure_diastolic' => ['nullable', 'integer', 'min:0', 'max:200'],
            'mood' => ['nullable', 'in:happy,neutral,sad,stressed,energetic'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $healthRecord->update($request->all());

        return redirect()->route('health.index')->with('success', 'Health record updated successfully!');
    }

    /**
     * Quick update for today's health data.
     */
    public function quickUpdate(Request $request)
    {
        $request->validate([
            'steps' => ['nullable', 'integer', 'min:0'],
            'calories_burned' => ['nullable', 'numeric', 'min:0'],
            'water_intake' => ['nullable', 'numeric', 'min:0'],
            'sleep_hours' => ['nullable', 'integer', 'min:0', 'max:24'],
            'mood' => ['nullable', 'in:happy,neutral,sad,stressed,energetic'],
        ]);

        $user = Auth::user();

        $todayRecord = HealthRecord::where('user_id', $user->id)
            ->where('record_date', today())
            ->first();

        if ($todayRecord) {
            $todayRecord->update($request->all());
        } else {
            HealthRecord::create(array_merge($request->all(), [
                'user_id' => $user->id,
                'record_date' => today(),
            ]));
        }

        return back()->with('success', 'Health data updated!');
    }

    /**
     * Show health reports.
     */
    public function reports(Request $request)
    {
        $user = Auth::user();
        
        $period = $request->get('period', 'week');
        
        if ($period === 'week') {
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
        } elseif ($period === 'month') {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
        } else {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
        }

        $records = HealthRecord::where('user_id', $user->id)
            ->whereBetween('record_date', [$startDate, $endDate])
            ->orderBy('record_date')
            ->get();

        // Calculate averages
        $averages = [
            'steps' => $records->avg('steps'),
            'calories' => $records->avg('calories_burned'),
            'water' => $records->avg('water_intake'),
            'sleep' => $records->avg('sleep_hours'),
        ];

        return view('health.reports', compact('records', 'averages', 'period'));
    }

    /**
     * Calculate BMI.
     */
    public function calculateBMI(Request $request)
    {
        $request->validate([
            'height' => ['required', 'numeric', 'min:0', 'max:300'],
            'weight' => ['required', 'numeric', 'min:0', 'max:500'],
        ]);

        $heightInMeters = $request->height / 100;
        $bmi = round($request->weight / ($heightInMeters * $heightInMeters), 2);

        $category = '';
        $color = '';

        if ($bmi < 18.5) {
            $category = 'Underweight';
            $color = 'warning';
        } elseif ($bmi < 25) {
            $category = 'Normal';
            $color = 'success';
        } elseif ($bmi < 30) {
            $category = 'Overweight';
            $color = 'warning';
        } else {
            $category = 'Obese';
            $color = 'danger';
        }

        return back()->with(compact('bmi', 'category', 'color'));
    }
}