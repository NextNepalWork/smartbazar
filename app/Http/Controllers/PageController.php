<?php

namespace App\Http\Controllers;

use App\Model\VendorDetail;
use App\Model\VendorWallet;
use App\Page;
use Illuminate\Http\Request;
use App\Model\Advertise;
use App\Model\Order;
use App\Model\Product;
use App\Model\VendorCoverImage;

use App\Model\Vendor;
use App\VendorRating;

class PageController extends Controller
{
    // protected $pageTemplate = 'pages.templates.';

       public function getPage($slug = null,Request $request)
    {
        $vendorprofile = VendorDetail::where('name', $slug)->whereNotIn('verified',['0'])->first();
        if ($vendorprofile) {
            $vendor = VendorDetail::where('id', '=', $vendorprofile->id)->first();
            $products = Product::where('status', '=', 'published')
                ->where('approved', 1)->where('user_id', '=', $vendor->user_id)->paginate(20);
            $orders_count = Order::where('user_id',$vendor->user_id)->get()->count();
            $rating=VendorRating::where('user_id',$vendor->user_id)->get();

            $cover= VendorCoverImage::where('vendor_details_id',$vendor->id)->first();
            if ($request->ajax()) {
                if ($request->has('lowtohigh')) {

                    $products = Product::where('user_id', '=', $vendor->user_id)->orderby('sale_price');
                }
                if ($request->has('hightolow')) {
                    if ($request->has('hightolow')) {

                        $products = Product::where('user_id', '=', $vendor->user_id)->orderby('sale_price', 'desc');
                    }

                }
                if ($request->has('popularity')) {
                    $products = Product::where('user_id', '=', $vendor->user_id)->orderby('created_at');
                }
                $products = $products->get();

                return view('mall.filter_pro', compact('products'));

            }

            return view('mall.vendor_profile', compact('vendor', 'products', 'cover','orders_count','rating'));
        }
        $page = Page::where('slug', $slug);
        $page = $page->firstOrFail();

        return view('pages.templates.default')
            ->with([
                'page' => $page,
            ]);
    }


    public function getMission()
    {
        return view('front.pages.mission');
    }

    public function getPayments()
    {
        return view('front.pages.payments');
    }

    public function getShipping()
    {
        return view('front.pages.shipping');
    }

    public function getReturnPolicy()
    {
        return view('front.pages.return_policy');
    }

    public function getPrivacyPolicy()
    {
        return view('front.pages.privacy_policy');
    }

    public function getTermsConditions()
    {
        return view('front.pages.terms_conditions');
    }

    public function getCancellation()
    {
        return view('front.pages.cancellation');
    }
}