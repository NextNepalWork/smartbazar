<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceLocation extends Model
{
    protected $fillable = [
        'service_id',
        'location',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function orderService(){
        return $this->belongsTo(OrderService::class);
    }
}
