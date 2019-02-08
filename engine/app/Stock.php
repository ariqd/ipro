<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = ['id'];

    public function scopeBrands($query, Array $brands)
    {
        return $query->orWhereIn('brand', $brands);
    }

    public function scopeBranches($query, Array $branches)
    {
        return $query->orWhereIn('branch', $branches);
    }
}
