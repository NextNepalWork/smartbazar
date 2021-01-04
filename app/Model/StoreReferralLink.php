<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StoreReferralLink extends Model
{
    protected $fillable = ['refer_link', 'product_link', 'token', 'super_vendor_id','product_id'];
}
