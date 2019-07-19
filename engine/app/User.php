<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'branch_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function commission()
    {
        return $this->hasOne('App\Commission');
    }

    public static function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function scopeSales($query)
    {
        return $query->where('role', 'sales');
    }

    public function checkIfAdmin()
    {
        if ($this->role == 'admin')
            return true;

        return false;
    }
}
