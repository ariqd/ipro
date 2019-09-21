<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_Order extends Model
{
    protected $guarded = ['id'];
    protected $table = 'delivery_orders';

    public function sales()
    {
        return $this->belongsTo('App\Sale', 'sales_order_id', 'id');
    }
}
