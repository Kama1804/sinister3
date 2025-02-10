<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}