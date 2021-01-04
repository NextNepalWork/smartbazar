<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceTime extends Model
{
    protected $fillable = [
        'service_id',
        'time',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
