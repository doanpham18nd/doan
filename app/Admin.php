<?php

namespace App;

use App\Http\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticate
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'name', 'username', 'password',

    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [

        'password', 'remember_token',

    ];
}
