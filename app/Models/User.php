<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'user';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'active',
        'token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
