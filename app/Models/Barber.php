<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    // Define the table associated with the model (optional if it's `barbers`)
    protected $table = 'barbers';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'name', 
        'outlet'
    ];

    // If your table does not use Laravel's default `created_at` and `updated_at` columns
    // Uncomment the following line
    // public $timestamps = false;

    /**
     * Relationships
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
