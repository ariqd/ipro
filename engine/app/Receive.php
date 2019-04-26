<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
	protected $guarded = [];
	protected $table = 'receives';

	public function sale()
	{
		return $this->belongsTo('App\Purchase_Detail', 'purchase_detail_id', 'id');
	}
}
