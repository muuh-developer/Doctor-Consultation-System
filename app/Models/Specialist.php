<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = ['name','contact_info', 'availability','specialization_id', 'specialization_name','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
