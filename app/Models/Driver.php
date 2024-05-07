<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'driver';

    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
}
