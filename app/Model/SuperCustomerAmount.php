<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuperCustomerAmount extends Model
{
    protected $fillable = ['super_customer_id', 'status', 'order_id', 'amount'];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }}
