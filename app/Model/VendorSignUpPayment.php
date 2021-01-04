<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VendorSignUpPayment extends Model
{
    protected $fillable = ['vendor_id', 'payment_method', 'status','ref_id','amount'];
}
