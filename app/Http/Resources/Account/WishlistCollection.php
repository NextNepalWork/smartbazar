<?php

namespace App\Http\Resources\Account;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WishlistCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'product_id' => $this->product,
            'product_image' => $this->product->getImageAttribute()->mediumUrl,
            'ratings' => getRatings($this->product->id)
        ];
    }
}
