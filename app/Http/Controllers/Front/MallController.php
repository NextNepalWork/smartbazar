<?php

namespace App\Http\Controllers\Front;

use App\Model\Advertise;
use App\Model\Product;
use App\Model\VendorDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MallController extends Controller
{
    public function vendor_profile(Request $request)
    {
        $vendor = VendorDetail::where('name', '=', $request->name)->first();
        $products = Product::where('approved',$approved=1)->where( 'status',$status='published' )->where('user_id', '=', $vendor->user_id)->paginate(2);
        $advertise = Advertise::where('user_id', $vendor->user_id)->first();
        if ($request->ajax()) {
            if ($request->has('lowtohigh')) {

                $products = Product::where('approved',$approved=1)->where( 'status',$status='published' )->where('user_id', '=', $vendor->user_id)->orderby('sale_price');
                
            }
            if ($request->has('hightolow')) {
                if ($request->has('hightolow')) {

                    $products = Product::where('approved',$approved=1)->where( 'status',$status='published' )->where('user_id', '=', $vendor->user_id)->orderby('sale_price', 'desc');
                }

            }
            if ($request->has('popularity')) {
                $products = Product::where('approved',$approved=1)->where( 'status',$status='published' )->where('user_id', '=', $vendor->user_id)->orderby('created_at');
            }
            $products = $products->get();

            return view('mall.filter_pro', compact('products'));

        }

        return view('mall.vendor_profile', compact('vendor', 'products', 'advertise'));
    }

    public function our_vendors(Request $request)
    {
        $vendors = VendorDetail::where('verified',1)->get();
        return view('mall.our_vendors', compact('vendors'));
    }
}
