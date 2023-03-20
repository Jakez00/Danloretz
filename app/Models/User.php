<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'role',
        'store',
        'password',
        'address',
        'created_by',
        'about'
    ];
    
}
