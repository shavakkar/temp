<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
