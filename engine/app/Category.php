<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    /*
     * 1 Category hanya dimiliki oleh 1 Brand
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
