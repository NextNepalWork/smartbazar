<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuperCustomerLink extends Model
{
    protected $fillable = ['refer_link', 'product_link', 'token', 'super_customer_id', 'product_id'];
}
