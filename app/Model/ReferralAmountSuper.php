<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReferralAmountSuper extends Model
{
    protected $fillable = ['super_vendor_id', 'status', 'order_id', 'amount'];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
