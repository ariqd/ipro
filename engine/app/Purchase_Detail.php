<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_Detail extends Model
{
	protected $guarded = [];
	protected $table = 'purchase_details';

	public function sale()
	{
		return $this->belongsTo('App\Purchase', 'id', 'purchase_id');
	}

	   public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
