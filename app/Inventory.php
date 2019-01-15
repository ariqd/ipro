<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = ['id'];

    public function scopeBrands($query, Array $brands)
    {
        return $query->whereIn('brand', $brands);
    }
}
