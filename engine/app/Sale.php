<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    protected $table = 'sales_orders';
    protected $fillable = [
        'customer_id',
        'user_id',
        'sales_id',
        'admin_id',
        'quotation_id',
        'project',
        'send_address',
        'send_date',
        'send_pic_phone',
        'payment_method',
        'note',
        'ongkir',
        'pic',
        'grand_total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

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

    public function scopeMySales($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeMyArea($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('branch_id', '=', Auth::user()->branch_id);
        });
    }

    public function delivery()
    {
        return $this->hasOne('App\Delivery_Order', 'sales_order_id');
    }
}
