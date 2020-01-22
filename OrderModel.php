<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    protected $fillable = ['customer_id','sub_total','tax_total','total_discount','total_price','given_price','change','address','status'];

    public function orders_details()
    {
        return $this->hasMany('App\Models\OrderDetailsModel','order_id');
    }
}
