<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_Order_Detail extends Model
{
    protected $guarded = [];
    protected $table = 'delivery_order_details';

    public function detail()
    {
        return $this->belongsTo('App\Sale_Detail', 'sales_order_detail_id', 'id');
    }
}
