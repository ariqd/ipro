<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $guarded = [];

	public function details()
	{
		return $this->hasMany('App\Purchase_Detail', 'purchase_id', 'id');
	}
}
