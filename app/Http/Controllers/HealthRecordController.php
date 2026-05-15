<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthRecordController extends Controller
{
    /**
     * Display the dashboard with health metrics.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Fetch the last 7 days of health records
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $last7Days->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }

        $records = HealthRecord::where('user_id', $user->id)
            ->where('record_date', '>=', Carbon::today()->subDays(6))
            ->orderBy('record_date')
            ->get()
            ->keyBy(function ($item) {
                return $item->record_date->format('Y-m-d');
            });

        $stepsData = [];
        $caloriesData = [];
        $labels = [];

        foreach ($last7Days as $date) {
            $labels[] = Carbon::parse($date)->format('D'); // Mon, Tue...
            if ($records->has($date)) {
                $stepsData[] = $records[$date]->steps ?? 0;
                $caloriesData[] = $records[$date]->calories_burned ?? 0;
            } else {
                $stepsData[] = 0;
                $caloriesData[] = 0;
            }
        }

        $todayRecord = HealthRecord::where('user_id', $user->id)
            ->whereDate('record_date', Carbon::today())
            ->first();

        // Calculate Dashboard Cards Data
        $totalPosts = \App\Models\Post::where('user_id', $user->id)->count();
        $totalRecords = HealthRecord::where('user_id', $user->id)->count();
        $totalAppointments = \App\Models\Appointment::where('user_id', $user->id)->count();
        $totalMessages = \App\Models\Message::where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->count();

        // Prepare data for React
        $dashboardData = [
            'labels' => $labels,
            'stepsData' => $stepsData,
            'caloriesData' => $caloriesData,
            'todayRecord' => $todayRecord,
            'stats' => [
                'totalPosts' => $totalPosts,
                'totalRecords' => $totalRecords,
                'totalAppointments' => $totalAppointments,
                'totalMessages' => $totalMessages
            ]
        ];

        // Pass to dashboard view
        return view('dashboard', compact('dashboardData'));
    }

    /**
     * Display the health history for the user.
     */
    public function history()
    {
        $user = Auth::user();
        
        $records = HealthRecord::where('user_id', $user->id)
            ->orderBy('record_date', 'desc')
            ->get();
            
        return view('health.history', compact('records'));
    }

    /**
     * Store a newly created health record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'steps' => ['nullable', 'integer', 'min:0'],
            'calories_burned' => ['nullable', 'numeric', 'min:0'],
            'water_intake' => ['nullable', 'numeric', 'min:0'],
            'sleep_hours' => ['nullable', 'numeric', 'min:0', 'max:24'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'bmi' => ['nullable', 'numeric', 'min:0'],
        ]);

        $record = HealthRecord::firstOrNew([
            'user_id' => Auth::id(),
            'record_date' => Carbon::today(),
        ]);

        $record->steps = $request->steps ?? $record->steps ?? 0;
        $record->calories_burned = $request->calories_burned ?? $record->calories_burned ?? 0;
        $record->water_intake = $request->water_intake ?? $record->water_intake ?? 0;
        $record->sleep_hours = $request->sleep_hours ?? $record->sleep_hours ?? 0;
        
        if ($request->weight) {
            $record->weight = $request->weight;
        }
        
        // Use height and bmi directly if they are passed or save them if there is a column
        // We will assume 'height' and 'bmi' columns exist or we will just use them in UI
        if ($request->has('height') && \Schema::hasColumn('health_records', 'height')) {
            $record->height = $request->height;
        }
        if ($request->has('bmi') && \Schema::hasColumn('health_records', 'bmi')) {
            $record->bmi = $request->bmi;
        }
        
        $record->save();

        return redirect()->route('dashboard')->with('success', 'Health metrics logged successfully!');
    }
}
