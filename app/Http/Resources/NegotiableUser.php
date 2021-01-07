<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NegotiableUser extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'products'=> globalproducts($this->product_id),
            'created_at'=>$this->created_at->format('d/m/y'),
            'updated_at'=>$this->updated_at->format('d/m/y'),
        ];
//        return parent::toArray($request);
    }
}
