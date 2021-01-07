<?php

namespace App\Http\Controllers\Frontend;

use App\Model\OrderService;
use App\Model\Service;
use App\Model\ServiceCategory;
use App\Model\ShippingAccount;
use App\Model\Slideshow;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public function index()
    {
        $serviceCategories = ServiceCategory::all();
        $slideshows = Slideshow::where('status', '=', 1)->where('option', 0)->orderBy('id', 'DESC')->take(5)->get();
        $services = Service::where('status', 1)->take(6)->get();
        return view('front.services.index', compact('serviceCategories', 'slideshows', 'services'));
    }

    public function getMenu()
    {
        $serviceCategories1 = ServiceCategory::all();
        return view('partials.service-header', compact('serviceCategories'));
    }

    public function showCategory($slug)
    {
        $serviceCategories = ServiceCategory::all();

        $serviceCategory = ServiceCategory::where('slug', $slug)->first();
        $services = Service::where('parent_id', $serviceCategory->id)->get();


        return view('front.services.services', compact('services', 'serviceCategories', 'serviceCategory'));

    }


    public function getService($slug)
    {
        $shipping = ShippingAccount::where('user_id', auth()->id())->where('is_default', 1)->first();
        $shipping_places = ShippingAccount::all();
//dd($shipping);
        $service = Service::where('slug', $slug)->where('status', 1)->first();
        $services = Service::where('status', 1)->take(10)->get();
        $serviceCategories = ServiceCategory::all();


        return view('front.services.single', compact('service', 'services', 'serviceCategories', 'shipping', 'shipping_places'));
    }

    public function store(Request $request)
    {

        $service = OrderService::create([
            'user_id' => Auth::user()->id,
            'address_id' => $request->input('address_id'),
            'service_id' => $request->input('service'),
            'service_location_id' => $request->input('location'),
            'service_time_id' => $request->input('time'),
            'description' => $request->input('description'),
        ]);
        if ($service) {

            return redirect()->back()
                ->with('success', 'Service created successfully');
        }

        return back()->withInput()->with('errors', 'Error creating new Service');


    }

    public function destroy($id)
    {
        $orderService = OrderService::find($id);


        $orderService->delete();

        if ($orderService) {

            return redirect()->back()
                ->with('success', 'Deleted successfully');
        }

    }

}
