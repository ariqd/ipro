<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receive_Detail extends Model
{
	protected $guarded = [];
	protected $table = 'receive_details';

	public function purchaseDetail()
	{
		return $this->belongsTo('App\Purchase_Detail', 'purchase_detail_id', 'id');
	}

}
