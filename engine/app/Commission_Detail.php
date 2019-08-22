<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission_Detail extends Model
{
    protected $guarded = [];
    protected $table = 'commissions_details';

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function sale()
    {
        return $this->belongsTo('App\Sale','sales_order_id','id');
    }
}
