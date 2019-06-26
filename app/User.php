<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the workcharts record associated with the user.
     */
    public function workcharts()
    {
        return $this->hasMany('App\Workchart');
    }

    /**
     * Get the workcharts record associated with the user.
     */
    public function intervals()
    {
        return $this->hasMany('App\Interval');
    }

    /**
     * Get the workcharts record associated with the user.
     */
    public function algos()
    {
        return $this->hasMany('App\Algo');
    }
}
