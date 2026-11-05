<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teleconsultation extends Model
{
    protected $fillable = [
        'appointment_id',
        'meeting_link',
        'started_at',
        'ended_at',
        'status',
        'notes'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}