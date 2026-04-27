<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'record_date',
        'steps',
        'calories_burned',
        'water_intake',
        'sleep_hours',
        'weight',
        'heart_rate',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'mood',
        'notes',
    ];

    protected $casts = [
        'record_date' => 'date',
        'calories_burned' => 'decimal:2',
        'water_intake' => 'decimal:2',
        'weight' => 'decimal:2',
        'heart_rate' => 'decimal:2',
    ];

    /**
     * Get the user that owns the health record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get blood pressure as string.
     */
    public function getBloodPressureAttribute(): string
    {
        if ($this->blood_pressure_systolic && $this->blood_pressure_diastolic) {
            return "{$this->blood_pressure_systolic}/{$this->blood_pressure_diastolic}";
        }
        return 'N/A';
    }

    /**
     * Calculate daily goal progress (steps).
     */
    public function getStepsProgressAttribute(): int
    {
        $goal = 10000; // Default daily step goal
        return min(100, round(($this->steps / $goal) * 100));
    }

    /**
     * Calculate water intake progress.
     */
    public function getWaterProgressAttribute(): int
    {
        $goal = 2.5; // Default daily water goal in liters
        return min(100, round(($this->water_intake / $goal) * 100));
    }
}
