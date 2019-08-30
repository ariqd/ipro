<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission_Detail extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
