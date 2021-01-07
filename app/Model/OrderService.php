<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{

    protected $fillable = [
        'address_id',
        'user_id',
        'service_id',
        'service_location_id',
        'service_time_id',
        'description',
        'status',
    ];

    public function serviceUser()
    {
        return $this->belongsTo(ServiceUser::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function locations()
    {
        return $this->belongsTo(ServiceLocation::class, 'service_location_id');
    }

    public function times()
    {
        return $this->belongsTo(ServiceTime::class, 'service_time_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function shippingAccount()
    {
        return $this->belongsTo(ShippingAccount::class, 'address_id');
    }

    public function serviceRating()
    {
        return $this->belongsTo(ServiceRating::class);
    }
}
