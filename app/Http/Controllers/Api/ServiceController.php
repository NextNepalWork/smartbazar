<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\OrderService;
use App\Model\Role;
use App\Model\Service;
use App\Model\ServiceCategory;
use App\Model\ServiceProviderInfo;
use App\Model\ServiceRating;
use App\Model\ServiceUser;
use App\Model\ShippingAccount;
use App\Model\Slideshow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->take(6)->get();
        foreach ($services as $service) {
            $service->image = $service->getImage() ? $service->getImage()->smallUrl : asset('/img/default-product.png');
        }

        return $services;
    }

    public function home()
    {
        $data['services'] = $this->index();
        $data['slideshow'] = $this->getSlideshows();
        $data['categories'] = $this->getCategories();

        return \response()->json($data, '200');

    }

    public function getSlideshows()
    {
        $slideshows = Slideshow::select('id', 'image')->where('status', '=', 1)->where('option', 0)->orderBy('id', 'DESC')->take(5)->get();
        foreach ($slideshows as $slideshow) {
            $slideshow->image = asset($slideshow->image);
        }

        return $slideshows;
    }

    public function getCategories()
    {
        $serviceCategories = ServiceCategory::select('id', 'name', 'description')->get();

        foreach ($serviceCategories as $serviceCategory) {
            $serviceCategory->image = $serviceCategory->getImage()->smallUrl;
        }

        return $serviceCategories;
    }

    public function getServiceAd()
    {
        $image = url('storage') . '/' . getConfiguration('service_index_ads_img');

        return response()->json(['ad' => $image], Response::HTTP_OK);
    }

    public function getCategoryServices($id)
    {
        $services = Service::where('parent_id', $id)->where('status', 1)->get();
        foreach ($services as $service) {
            $service->image = $service->getImage() ? $service->getImage()->smallUrl : asset('/img/default-product.png');
        }

        return $services;
    }

    public function getServiceDetails($id)
    {
        $shipping = ShippingAccount::where('user_id', auth('api')->id())->where('is_default', 1)->first();
        $service = Service::where('id', $id)->where('status', 1)->first();
        $service->image = $service->getImage() ? $service->getImage()->smallUrl : asset('/img/default-product.png');
        $service->times = $service->times;
        $service->locations = $service->locations;
        $service->shipping = $shipping;

        return response()->json($service, Response::HTTP_OK);
    }

    public function getServiceReviews($id)
    {
        $service = Service::where('id', $id)->where('status', 1)->first();
        $reviews = $service->serviceRatings;

        foreach ($reviews as $review) {
            $review->name = $review->users->first_name . ' ' . $review->users->last_name;
            unset($review->users);
        }

        return response()->json($reviews, Response::HTTP_OK);
    }

    public function getRelatedServices($id)
    {

        $service = Service::where('id', $id)->where('status', 1)->first();
        $services = Service::where('parent_id', $service->parent_id)->where('id', '!=', $service->id)->where('status', 1)->take(10)->get();

        foreach ($services as $service) {
            $service->image = $service->getImage() ? $service->getImage()->smallUrl : asset('/img/default-product.png');
        }

        return response()->json($services, Response::HTTP_OK);
    }

    public function storeServiceOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'service_id' => 'required',
            'service_time_id' => 'required',
            'service_location_id' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], Response::HTTP_NOT_ACCEPTABLE);
        }

        $service = OrderService::create([
            'user_id' => auth('api')->id(),
            'address_id' => $request->input('address_id'),
            'service_id' => $request->input('service_id'),
            'service_location_id' => $request->input('service_location_id'),
            'service_time_id' => $request->input('service_time_id'),
            'description' => $request->input('description')
        ]);

        return response()->json(['msg' => 'Service Order placed successfully!'], Response::HTTP_CREATED);
    }

    public function getOrderServices()
    {
        $services = OrderService::where('user_id', auth('api')->id())->get();

        foreach ($services as $service) {
            $service->name = $service->service->name;
            $service->image = $service->service->getImage() ? $service->service->getImage()->smallUrl : asset('/img/default-product.png');
            $service->location = $service->locations->location;
            $service->time = $service->times->time;
            unset($service->service);
            unset($service->times);
            unset($service->locations);
        }

        return response()->json($services, Response::HTTP_OK);
    }

    public function getServiceOrderDetails($id)
    {
        $service = OrderService::where('id', $id)->first();
        $service->name = $service->service->name;
        $service->image = $service->service->getImage() ? $service->service->getImage()->smallUrl : asset('/img/default-product.png');
        $service->location = $service->locations->location;
        $service->time = $service->times->time;
        $service->provider = ServiceUser::where('order_service_id', $service->id)->first()->serviceProvider->name;
        unset($service->service);
        unset($service->times);
        unset($service->locations);

        return response()->json($service, Response::HTTP_OK);
    }

    public function serviceRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'order_service_id' => 'required',
            'stars' => 'required',
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], Response::HTTP_NOT_ACCEPTABLE);
        }

        $provider = ServiceUser::where('order_service_id', $request->input('order_service_id'))->first();

        $serviceRating = ServiceRating::updateOrCreate([
            'order_service_id' => $request->input('order_service_id')], [
            'user_id' => auth('api')->id(),
            'service_id' => $request->input('service_id'),
            'provider_id' => $provider->provider_id,
            'order_service_id' => $request->input('order_service_id'),
            'stars' => $request->input('stars'),
            'review' => $request->input('review'),
        ]);

        return response()->json(['msg' => 'You have successfully rated service provider!'], Response::HTTP_CREATED);
    }

    public function cancelServiceOrder($id)
    {
        $service = OrderService::where('id', $id)->first();
        $service->update(['status' => 'cancelled']);

        return response()->json(['msg' => 'Service Order successfully cancelled!'], Response::HTTP_OK);
    }

    public function searchServices(Request $request)
    {
        $query = $request->get('query');

        $services = Service::where('name', 'like', '%' . $query . '%')->orWhere('slug', 'like', '%' . $query . '%')->where('status', 1)->get();
        foreach ($services as $service) {
            $service->image = $service->getImage() ? $service->getImage()->smallUrl : asset('/img/default-product.png');
        }

        return response()->json($services, Response::HTTP_OK);
    }

    public function sellService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'primary_email' => 'required|email',
            'service_category_id' => 'required',
            'address' => 'required',
            'primary_phone' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], Response::HTTP_NOT_ACCEPTABLE);
        }

        $provider = ServiceProviderInfo::where('user_id', auth('api')->id())->first();

        if (!$provider) {
            $info = ServiceProviderInfo::updateOrCreate([
                'user_id' => auth('api')->id(),
                'name' => $request->input('name'),
                'primary_email' => $request->input('primary_email'),
                'primary_phone' => $request->input('primary_phone'),
                'pan_number' => $request->input('pan_number'),
                'service_category_id' => $request->input('service_category_id'),
                'address' => $request->input('address'),
            ]);

            if ($info) {
                $user = User::findorfail(auth('api')->id());
                $role = Role::where('name', 'service')->first()->id;
                $user->roles()->sync($role);

                return response()->json(['msg' => 'Provider Request successfully sent!'], Response::HTTP_CREATED);
            }
        } else {
            return response()->json(['error' => 'Provider Already Register'], Response::HTTP_ALREADY_REPORTED);
        }
    }
}
