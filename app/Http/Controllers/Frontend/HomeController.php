<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Advertise;
use App\Model\Brand;
use App\Model\Coupon;
use App\Model\Deal;
use App\Model\Order;
use App\Model\Product;
use App\Model\Seo;
use App\Model\Slideshow;
use App\Model\Team;
use App\Model\Vendor;
use App\Model\VendorDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            if (Session::has('times')) {
                if (Session::get('times') == 1) {
                    $products = Product::where('status', '=', 'published')
                        ->where('approved', 1)->latest()->take(24)->get();
                    Session::put('times', 2);
                    return view('front.reloadmore', compact('products'));
                }
                if (Session::get('times') == 2) {
                    $products = Product::where('status', '=', 'published')
                        ->where('approved', 1)->latest()->take(36)->get();
                    Session::put('times', 3);
                    return view('front.reloadmore', compact('products'));
                }
                if (Session::get('times') == 3) {
                    $products = Product::where('status', '=', 'published')
                        ->where('approved', 1)->latest()->take(48)->get();
//                    Session::put('times', 1);
                    return view('front.reloadmore', compact('products'));
                }
            }

            $products = Product::where('status', '=', 'published')
                ->where('approved', 1)->latest()->take(12)->get();
            Session::put('times', 1);
            return view('front.reloadmore', compact('products'));


        }
        $slideshows = Slideshow::where('status', '=', 1)->where('option', 1)->orderBy('id', 'DESC')->take(5)->get();
        $brands = Brand::where('status', 1)->take('10')->get();
        $seos = Seo::where('status', 1)->get();
        $advertises = Advertise::where('status', 2)->take(10)->get();
        $mall = VendorDetail::where('verified', 1)->get();
        $superstore = Product::where('status', '=', 'published')
            ->where('approved', 1)->where('super_store_status', 1)->latest()->get();
        $deals = Deal::whereHas('products')->with('products')->orderBy('id', 'desc')->get();
        //dd($mall->first()->image);
        return view('front.index', compact('slideshows', 'brands', 'seos', 'advertises', 'mall', 'superstore', 'deals'));
    }


    public function single($id)
    {
        $products = Product::findOrFail($id);
        return view('front.single', compact('products'));
    }

    public function quickView($id)
    {
        $product = Product::findOrFail($id);
        $colours = $product->additionals->pluck('color')->toArray();
        $sizes = $product->additionals->pluck('size')->toArray();
        $shop = VendorDetail::where('user_id', $product->user_id)->first();
        $shop_name = $shop ? $shop->name : 'NA';

        return view('front.quick_view', compact('product', 'sizes', 'colours', 'shop_name'));
    }

    public function matchCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();
        if (empty($coupon)) {
            return redirect()->back()->with(['error' => 'This coupon is not valid for this product.']);
        } else {
            $date = Carbon::now()->format('Y-m-d');
            if ($coupon->uses_per_coupon != 0 && $coupon->end_date >= $date) {
                $coupon_user = DB::table('coupon_user')->where('user_id', auth()->id())->where('coupon_id', $coupon->id)->first();
                if (empty($coupon_user)) {
                    $coupon->uses_per_coupon = $coupon->uses_per_coupon - 1;
                    $coupon->update();
                    DB::table('coupon_user')->insert(['coupon_id' => $coupon->id, 'user_id' => auth()->id()]);
                    return $coupon;
                } else {
                    return 'This coupon is already been used.';
                }
            } else {
                return redirect()->back()->with(['error' => 'This coupon is not valid for this product.']);
            }
        }
    }

    public function checkTrack(Request $request)
    {
        $order = Order::where('code', $request->order_code)->first();
        return view('front.track_order', compact('order'));
    }

    public function getTrack()
    {
        return view('front.track_order');
    }

    public function aboutUs()
    {
        $about = Team::all();
        return view('front.about_us', compact('about'));
    }

}
