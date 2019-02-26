<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function scopeBrands($query, Array $brands)
    {
        return $query->leftjoin("items", "items.id", "stocks.item_id")->leftjoin("brands", "brands.id", "item.brand_id")->orWhereIn('brands', $brands);
    }

    public function scopeBranches($query, Array $branches)
    {
        return $query->orWhereIn('branch', $branches);
    }
}
