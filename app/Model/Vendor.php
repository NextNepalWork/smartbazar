<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'primary_email',
        'secondary_email',
        'primary_phone',
        'secondary_phone',
        'address',
        'tax_clearance'
    ];

    protected $table = 'vendor_details';

    public function vendor_address_details()
    {
        return $this->hasMany(VendorAddressDetail::class);
    }

//    public function vendor_details()
//    {
//    	return $this->hasMany(VendorDetail::class);
//    }

    public function documents()
    {
        return $this->hasMany(VendorDocument::class, 'vendor_detail_id');
    }

    public function seos()
    {
        return $this->hasMany(VendorSeo::class, 'vendor_detail_id');
    }

    public function socials()
    {
        return $this->hasMany(VendorSocial::class, 'vendor_detail_id');
    }

    public function category()
    {
        return $this->hasMany(VendorCategory::class, 'vendor_detail_id');
    }

    public function withdrawl()
    {
        return $this->hasMany(WithDraw::class, 'user_id');
    }

    public function company_images()
    {
        return $this->hasMany(VendorCompanyImage::class, 'vendor_details_id');
    }

}
