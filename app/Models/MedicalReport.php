<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MedicalReport extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'title',
        'diagnosis',
        'file_path',
        'ai_summary',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
