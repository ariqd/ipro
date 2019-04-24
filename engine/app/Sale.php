<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales_orders';
    protected $fillable = [
        'customer_id',
        'user_id',
        'quotation_id',
        'project',
        'send_address',
        'send_date',
        'send_pic_phone',
        'payment_method',
        'note'
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function details()
    {
        return $this->hasMany('App\Sale_Detail', 'sales_order_id', 'id');
    }

    public function scopeNotApproved()
    {
        return $this->whereNull("no_so");
    }
}
