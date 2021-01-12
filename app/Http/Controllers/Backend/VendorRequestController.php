<?php

namespace App\Http\Controllers\Backend;

use App\Model\Configuration;
use App\Model\SuperCustomerCommissionRate;
use App\Model\SuperCustomerWallet;
use App\Model\SuperVendorCommissionRate;
use App\Model\Vendor;
use App\Model\VendorDetail;
use App\Model\VendorWallet;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorRequest;
use App\Model\VendorSignUpPayment;


class VendorRequestController extends Controller
{
    public function index()
    {
        $requests = VendorDetail::where('verified', 0)->get();
        return view('admin.request_vendors', compact('requests'));
    }
 public function change_status(Request $request)
    {
         if ($request->isMethod('Put')) {
               if(!VendorSignUpPayment::where('id',$request->id)->first()){
                return redirect()->back()->with('success','Payment Method not Selected by Vendor');
            }
            $find = VendorSignUpPayment::findorfail($request->id);
          
            $find->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Status Changed Successfully');

        }
        return false;
    }

    public function accept(Request $request)
    {
        $request = VendorDetail::findorfail($request->id);
        $request->verified = 1;
        $request->update();
        $user = User::findorfail($request->user_id);
        $role = \App\Model\Role::where('name', 'vendor')->first()->id;
        $user->roles()->sync($role);

        $data = [
            'name' => $request->name,
            'status' => 'Accepted'
        ];
        Mail::to($request->primary_email)->send(new VendorRequest($data));
        return redirect()->back()->with('success', 'Status Changed SucessFully');

    }

    public function reject(Request $request)
    {
        $request = VendorDetail::findorfail($request->id);
        $data = [
            'name' => $request->name,
            'status' => 'Rejected'
        ];
        Mail::to($request->primary_email)->send(new VendorRequest($data));
        return redirect()->back()->with('success', 'Status Changed SucessFully');
    }

    public function delete(Request $request)
    {
        $request = VendorDetail::findorfail($request->id);
        $request->delete();
        return redirect()->back()->with('success', 'Deleted sucessfully');
    }

    public function view($id)
    {
        $request = VendorDetail::findorfail($id);
        return view('admin.request_view', compact('request'));
    }

    public function set_commission(Request $request)
    {
        if ($request->isMethod('get')) {
            $super = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', '=', 'Super-Vendor')
                ->select('users.*')
                ->get();
            return view('admin.super_vendor_commission', compact('super'));
        }
        if ($request->isMethod('post')) {
            $updateorcreate = SuperVendorCommissionRate::updateorcreate(['user_id' => $request->user_id], ['commission_rate' => $request->vendor_commission_rate]);
            return redirect()->back()->with('success', 'Commission Rate Set');
        }
        return false;
    }

    public function set_global_commission(Request $request)
    {
        $global = $request->global_vendor_commission;
        $inputkeys = $request->only('global_vendor_commission');
        foreach ($inputkeys as $key => $value) {
            $update = Configuration::updateorcreate(['configuration_key' => $key], ['configuration_value' => $value]);
        }
        return redirect()->back()->with('success', 'Global Commission Set');

    }

    public function referrals(Request $request)
    {
        if ($request->isMethod('get')) {
            $supervendor = User::wherehas('roles', function ($query) {
                $query->where('roles.id', '7');
            })->get();
            return view('admin.super_vendor_referrals', compact('supervendor'));
        }
        if ($request->isMethod('post')) {

            $request->validate([
                'payment' => 'required|numeric'
            ]);
            $payment_amount = $request->payment;
            $supervendor_id = $request->super_vendor_id;

            $total_amount = VendorWallet::where('super_vendor_id', $supervendor_id)->first()->total_amount;

            $deduction = $total_amount - $payment_amount;


            $save = VendorWallet::where('super_vendor_id', $supervendor_id)->update(['total_amount' => $deduction]);
            if ($save) {
                return redirect()->back()->with('success', 'Amount Paid');
            }


        }
    }

    public function SuperCustomer_commissions(Request $request)
    {
        if ($request->isMethod('get')) {
            $supercustomer = User::wherehas('roles', function ($query) {
                $query->where('roles.id', 8);
            })->get();
            return view('admin.super_customer_commission', compact('supercustomer'));

        }
        if ($request->isMethod('post')) {
            $updateorcreate = SuperCustomerCommissionRate::updateorcreate(['user_id' => $request->user_id], ['commission_rate' => $request->supercustomer_commission_rate]);
            return redirect()->back()->with('success', 'Commission Rate Set');
        }
        return false;
    }

    public function SuperCustomer_referrals(Request $request)
    {
        if ($request->isMethod('get')) {
            $supercustomer = User::wherehas('roles', function ($query) {
                $query->where('roles.id', '8');
            })->get();
            return view('admin.super_customer_referrals', compact('supercustomer'));
        }

        if ($request->isMethod('post')) {

            $request->validate([
                'payment' => 'required|numeric'
            ]);
            $payment_amount = $request->payment;
            $supercustomer_id = $request->super_customer_id;

            $total_amount = SuperCustomerWallet::where('super_customer_id', $supercustomer_id)->first()->total_amount;

            $deduction = $total_amount - $payment_amount;


            $save = SuperCustomerWallet::where('super_customer_id', $supercustomer_id)->update(['total_amount' => $deduction]);
            if ($save) {
                return redirect()->back()->with('success', 'Amount Paid');
            }


        }
    }
}
