<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_Detail extends Model
{
	protected $guarded = ['id'];
	protected $table = 'sales_order_details';


	public function stock()
	{
		return $this->hasOne('App\Stock', 'id', 'stock_id');
	}

	public function sale()
	{
		return $this->belongsTo('App\Sale', 'id');
	}
}
