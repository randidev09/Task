<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'verification_code',
        'token_auth'
    ];

    protected $hidden = [
        'password'
    ];
}
