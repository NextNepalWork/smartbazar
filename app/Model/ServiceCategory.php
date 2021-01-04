<?php

namespace App\Model;

use App\Concern\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
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
        ];

    public function services(){

        return $this->hasMany(Service::class,'parent_id');
    }

    public function serviceProvider(){

        return $this->hasMany(ServiceProviderInfo::class);
    }
}
