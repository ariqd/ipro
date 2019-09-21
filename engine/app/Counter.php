<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $guarded = ['id'];

    public function scopePO($query) 
    {
        return $query->where('name', '=', 'PO')->first();
    }
}
