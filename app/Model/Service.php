<?php

namespace App\Model;

use App\Concern\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Sluggable,  Mediable;

    public function sluggable() {
        return [
            'slug' => [
                'source' => ['name']

            ]
        ];
    }
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
    ];

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class , 'parent_id');
    }
    public function locations(){
        return $this->hasMany(ServiceLocation::class);
    }
    public function times(){
        return $this->hasMany(ServiceTime::class);
    }
    public function serviceOrders(){
        return $this->hasMany(OrderService::class);
    }
    public function serviceRatings(){

        return $this->hasMany(ServiceRating::class);
    }
    public function serviceUser(){

        return $this->belongsToMany(ServiceUser::class);
    }



    public function serviceProviderInfo()
    {
        return $this->belongsToMany(ServiceProviderInfo::class);
    }
    public function providerService()
    {
        return $this->belongsToMany(ProdiverService::class);
    }
}
