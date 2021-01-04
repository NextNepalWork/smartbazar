<?php

namespace App\Repositories\Eloquent;

use App\Model\Vendor;
use App\Repositories\Contracts\VendorRepository;

use Illuminate\Support\Facades\Storage;
use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentVendorRepository extends AbstractRepository implements VendorRepository
{
    public function entity()
    {
        return Vendor::class;
    }

    public function vendorDetailsStore(array $attributes)
    {
        $attributes['user_id'] = auth()->id();
        $details = $this->entity->updateOrCreate(['user_id'=>$attributes['user_id']], $attributes);

        $details->socials()->updateOrCreate([
            'facebook_url' => $attributes['facebook_url'],
            'google_url' => $attributes['google_url'],
            'twitter_url' => $attributes['twitter_url'],
            'instagram_url' => $attributes['instagram_url'],
        ]);

        $details->seos()->updateOrCreate([
            'seo_keywords' => $attributes['seo_keywords'],
            'seo_description' => $attributes['seo_description'],
        ]);

        $details->category()->updateOrCreate([
            'category' => $attributes['category']
        ]);

        return $details;
    }
}
