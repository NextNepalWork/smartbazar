<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'pan_number',
        'registration_no',
    	'primary_email',
        'secondary_email',
        'primary_phone',
        'secondary_phone',
        'address',
        'verified',
        'tax_clearance'
    ];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    public function company_images()
    {
        return $this->hasMany(VendorCompanyImage::class, 'vendor_details_id');
    }

}
