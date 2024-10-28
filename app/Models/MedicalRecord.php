<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'doctor_id', 'record_datetime', 'description','symptoms'];
    protected $casts = [
        'record_datetime' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function medicalResult()
    {
        return $this->hasOne(MedicalResult::class);
    }
    public function medicalResults()
    {
        return $this->hasMany(MedicalResult::class);
    }
}
