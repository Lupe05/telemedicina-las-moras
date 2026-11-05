<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalAttention extends Model
{
    protected $fillable = [
        'appointment_id',
        'attention_date',
        'clinical_notes',
        'diagnosis',
        'indications',
    ];

    protected function casts(): array
    {
        return [
            'attention_date' => 'datetime',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}