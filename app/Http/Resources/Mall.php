<?php

namespace App\Http\Resources;

use App\Model\Vendor;
use Illuminate\Http\Resources\Json\Resource;

class Mall extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $vendor = Vendor::where('id', '=', $this->id)->get();
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'image' => $this->company_images->first() ?asset('vendor_company_image/'.$this->company_images->first()->image)  : asset('default_image/default.png')];
    }

}
