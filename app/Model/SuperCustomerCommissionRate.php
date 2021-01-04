<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuperCustomerCommissionRate extends Model
{
    protected $fillable=['user_id','commission_rate'];
}
