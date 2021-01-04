<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VendorCoverImage extends Model
{
    protected $fillable = ['vendor_details_id', 'cover_image'];
}
