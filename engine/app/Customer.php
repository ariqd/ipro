<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function scopeMine($query) 
    {
        return $query->where('user_id', Auth::id());
    }
}
