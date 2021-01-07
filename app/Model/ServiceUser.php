<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    protected $fillable = [
        'provider_id',
        'order_service_id',
        'status'
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProviderInfo::class,'provider_id');
    }
    public function orderService()
    {
        return $this->hasMany(OrderService::class, 'order_service_id');
    }
}
