<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = ['id'];

    /*
     * 1 Brand bisa memiliki banyak Category
     */
    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}
