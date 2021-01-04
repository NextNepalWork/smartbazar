<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'order_service_id',
        'provider_id',
        'stars',
        'review',
        'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function OrderService()
    {
        return $this->hasOne(OrderService::class, 'order_service_id');
    }
}
