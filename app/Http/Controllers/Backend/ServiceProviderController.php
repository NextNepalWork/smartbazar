<?php

namespace App\Http\Controllers\Backend;

use App\Model\OrderService;
use App\Model\Service;
use App\Model\ServiceProviderInfo;
use App\Model\ServiceRating;
use App\Model\ServiceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceProviderController extends Controller
{

    public function index(){


        $serviceProvider = ServiceProviderInfo::all();

        return view('admin.service.serviceProvider.index');
    }


    public function getProviderJson(){

        $serviceProvider = ServiceProviderInfo::all();

        return datatables($serviceProvider)->toJson();

    }


    public function prodiverStats($id){

        $providerId =  $id;
        $providerReviews = ServiceRating::where('provider_id',$id)->count();
        $providerRating = ServiceRating::where('provider_id',$id)->sum('stars');
        $service = ServiceUser::where('provider_id',$id)->count();
        $servicePending = ServiceUser::where('provider_id',$id)->where('status', 'pending')->count();
        $serviceApprove = ServiceUser::where('provider_id',$id)->where('status', 'approve')->count();
        $serviceComplete = ServiceUser::where('provider_id',$id)->where('status', 'complete')->count();
        $serviceCancelled = ServiceUser::where('provider_id',$id)->where('status', 'cancelled')->count();

        return view('admin.service.serviceProvider.stats', compact('service', 'providerId', 'providerReviews', 'providerRating', 'serviceApprove', 'serviceCancelled', 'serviceComplete', 'servicePending'));
    }


    public function prodiverStatsIndex(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        $providerName = ServiceProviderInfo::where('id', $id)->pluck('name')->first();
        if($status == 'all') {
            $orders = ServiceUser::where('provider_id', $id)->get();
        }else{
            $orders = ServiceUser::where('provider_id', $id)->where('status', $status)->get();
        }

        $ordersCount = $orders->count();

        $serviceOrders =[];
        foreach ($orders as $serviceUser){

          $serviceOrders []= OrderService::where('id', $serviceUser->order_service_id)->first();
//            dd($serviceOrders->serviceUser);
        }



        return view('admin.service.serviceProvider.stat-index', compact('serviceOrders', 'ordersCount', 'providerName'));

    }


    public function prodiverRatingIndex(Request $request){

        $id = $request->input('id');



        $providerName = ServiceProviderInfo::where('id', $id)->pluck('name')->first();

        $serviceReviews = ServiceRating::where('provider_id', $id)->get();


        return view('admin.service.serviceProvider.reviews', compact('providerName', 'serviceReviews'));

    }





}
