<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalIndication extends Model
{
    protected $fillable = [
        'medical_record_id',
        'description',
        'instructions',
        'indication_date'
    ];

    protected $casts = [
        'indication_date' => 'date',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}