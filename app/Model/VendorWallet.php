<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VendorWallet extends Model
{
    protected $fillable = ['super_vendor_id', 'total_amount'];
}
