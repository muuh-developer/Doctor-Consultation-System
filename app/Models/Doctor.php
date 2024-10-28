<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'gender','specialization', 'contact_info'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'user');
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'doctor_specialist');
    }
    public function medicalResults()
{
    return $this->hasMany(MedicalResult::class);
}
}
