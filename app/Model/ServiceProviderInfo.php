<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderInfo extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'primary_email',
        'secondary_email',
        'primary_phone',
        'secondary_phone',
        'pan_number',
        'service_category_id',
        'citizenship_number',
        'address',
        'seo_keywords',
        'seo_description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceUser()
    {
        return $this->belongsTo(ServiceUser::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function providerServices()
    {
        return $this->belongsToMany(ProdiverService::class);
    }


    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
