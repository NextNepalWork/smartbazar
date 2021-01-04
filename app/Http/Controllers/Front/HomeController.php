<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Deal;
use App\User;
use App\Model\Product;
use App\Model\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
       
      
        $slideshows = Slideshow::where('status', '=', 1)->orderBy('id', 'DESC')->take(5)->get();
        $brands = Brand::all();
        $deals = Deal::all();
        
        return view('front.index', compact('slideshows', 'brands'));
    }

    public function single($id)
    {
        $products = Product::findOrFail($id);
        return view('front.single', compact('products'));
    }

    public function sellWithUs()
    {
        if(Auth::check())
        {
            $user_id = auth()->id();
            $user = User::find($user_id);
        }
        else
        {
            $user= null;
        }
      
      
        if (Auth::user()->hasRole('vendor')) {
            return redirect()->route('vendor.dashboard');
        }
        return view('front.sell', compact('user'));
    }

    public function become_a_seller(Request $request)
    {
        $user = null;
        return view('front.sellerpage', compact('user'));

    }
}
