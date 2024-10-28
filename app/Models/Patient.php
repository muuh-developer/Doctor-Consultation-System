<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date_of_birth', 'gender', 'contact_info', 'address'];

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
}
