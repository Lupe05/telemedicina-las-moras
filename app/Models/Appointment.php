<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'professional_id',
        'appointment_date',
        'reason',
        'status',
        'observations'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function teleconsultation()
    {
        return $this->hasOne(Teleconsultation::class);
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
    public function medicalAttention(): HasOne
{
    return $this->hasOne(MedicalAttention::class);
}
}