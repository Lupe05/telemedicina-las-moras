<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'appointment_id',
        'diagnosis',
        'observations',
        'attention_date'
    ];

    protected $casts = [
        'attention_date' => 'date',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function indications()
    {
        return $this->hasMany(MedicalIndication::class);
    }
}