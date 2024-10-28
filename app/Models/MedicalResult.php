<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'medical_record_id',
        'result',
        'prescription',
        'advice',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
