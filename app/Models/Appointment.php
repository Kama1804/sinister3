<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_date',
        'appointment_time',
        'outlet',
        'barber_id',
        'services',
        'customer_name',
        'phone',
        'user_id'
    ];

    // If services is stored as JSON, you might need this cast
    protected $casts = [
        'services' => 'array'
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add relationship with Barber model
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}