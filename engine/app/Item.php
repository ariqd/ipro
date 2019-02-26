<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $guarded = ['id'];

	/*
	 * 1 Item hanya dimiliki oleh 1 category dan 1 brand
	 */
    public function category()
    {
        return $this->belongsTo('App\Category');
	}
}
