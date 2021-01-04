<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SuperVendorReferral extends Model
{
    protected $fillable = ['user_id', 'referral_id', 'status','created_at','updated_at'];

    public function referrals()
    {
        return $this->belongsTo(User::class, 'referral_id', 'id');
    }
}
