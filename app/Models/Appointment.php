<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'title',
        'description',
        'appointment_date',
        'duration',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    /**
     * Get the user (patient) that owns the appointment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor for the appointment.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Check if appointment is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->appointment_date->isFuture() && 
               in_array($this->status, ['pending', 'confirmed']);
    }

    /**
     * Check if appointment can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               $this->appointment_date->isFuture();
    }

    /**
     * Get formatted appointment time.
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->appointment_date->format('h:i A');
    }

    /**
     * Get formatted appointment date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->appointment_date->format('F j, Y');
    }
}
