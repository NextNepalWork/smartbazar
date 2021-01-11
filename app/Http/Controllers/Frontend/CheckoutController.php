<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\PaymentMethod;

use App\Model\Referral;
use App\Model\ReferralAmountSuper;
use App\Model\ReferralInfo;
use App\Model\ReferredUserSave;
use App\Model\ShippingAccount;
use App\Model\ShippingAmount;
use App\Model\StoreReferralLink;
use App\Model\SuperCustomerAmount;
use App\Model\SuperCustomerCommissionRate;
use App\Model\SuperCustomerLink;
use App\Model\SuperVendorCommissionRate;
use App\Model\Vendor;
use App\Model\VendorWallet;
use App\Model\Wallet;
use App\Repositories\Contracts\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderSent;
use Illuminate\Support\Facades\Auth;
use App\User;


class CheckoutController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        return $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $user = auth()->id();
        $verified = User::find($user)->verified;
        if ($verified == 0) {
            return redirect()->back()->with('error', 'Your Account has not been verified. Please check your email and verified! To resend email, go to your account.');
        }

        $shipping = ShippingAccount::where('user_id', auth()->id())->where('is_default', 1)->first();
        $shipping_places = ShippingAmount::all();
        $paymentMethod = PaymentMethod::all();
        // dd($paymentMethod);
        return view('front.checkout.checkout', compact('shipping', 'shipping_places', 'paymentMethod'));
    }

    public function handleCheckout(Request $request)
    {

        $this->validate($request, [
            'shipping_address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|string|max:255',
            'country' => 'required',
            'area' => 'required',
            'district' => 'required',
            'zone' => 'required',
            'mobile' => 'required|min:9|max:15',
        ]);
        // dd($request->all());

        $ship_location = ShippingAmount::where('place', $request->shipping_address)->first();

        if ($ship_location == null) {
            return redirect()->back()->with('error', 'Invalid location !');
        }
        $cartContents = Cart::content();
        try {
            if (isset($cartContents) && $cartContents->isEmpty()) {
                return redirect()->back()->with('error', 'There is no item in your cart');
            }

            $order = $this->orderRepository->store($request->all());
            $code = $order->code;
        } catch (\Exception $e) {
            throw new \Exception('Error in saving order: ' . $e->getMessage());
        }
        $data2 = [
            'name' => $request->first_name . '  ' . $request->last_name,
            'products' => $cartContents,
            'subject' => 'Order Received',
            'ship_amount' => $ship_location->amount,
            'order' => $order
        ];
        if (Session::has('referral') && Session::has('super_vendor_id')) {
            $super_vendor_id = Session::get('super_vendor_id');
            $referral = Session::get('referral');
            $referralamountsupersave = ReferralAmountSuper::create([
                'super_vendor_id' => $super_vendor_id,
                'order_id' => $order->id,
                'status' => $order->order_status_id,
                'amount' => $referral
            ]);
            //            $referred_amount = VendorWallet::where('super_vendor_id', $super_vendor_id)->first()->total_amount;
            //            VendorWallet::where('super_vendor_id', $super_vendor_id)->update(['total_amount' => $referred_amount + $referral]);
        }
        if (Session::has('super_customer_referral') && Session::has('super_customer_id')) {
            $super_customer_id = Session::get('super_customer_id');
            $referral = Session::get('super_customer_referral');
            $referralamountsupersave = SuperCustomerAmount::create([
                'super_customer_id' => $super_customer_id,
                'order_id' => $order->id,
                'status' => $order->order_status_id,
                'amount' => $referral
            ]);
        }
        // $total_amount = $request->total_amount;
        // if ($order->payment_method_id == 1) {
        //     return view('front.checkout.order_status', compact('total_amount', 'order'));
        // }

        // \Mail::to($request->email)->send(new OrderSent($data2));
        Session::flash('order', 'Saved!');
        return view('front.checkout.order_status', compact('code'));
    }

    public function handleOrderStatus()
    {
        if (session('order')) {
            $title = 'Order Received';
        } else {
            $title = 'Order';
        }

        return view('front.checkout.order_status', compact('title'));
    }

    public function shippingAmount(Request $request)
    {
        $subTotal = 0;
        $tax = 0;
        $amount = \App\Model\ShippingAmount::where('place', $request->location)->first();
        $amount = $amount->amount;

        if (Cart::count() != 0) {
            foreach (Cart::instance('default')->content() as $cartContent) {
                if (\App\Model\Product::where('id', $cartContent->id)->first()->prebooking == 1) {
                    $subTotal += ((($cartContent->qty * $cartContent->price) * 10) / 100);
                    if (\App\Model\Product::findOrFail($cartContent->id)->tax) {
                        $tax += 0;
                    }
                    $amount = 0;
                } else {
                    $subTotal += $cartContent->qty * $cartContent->price;
                    if (\App\Model\Product::findOrFail($cartContent->id)->tax) {
                        $tax += (($cartContent->qty * $cartContent->price) * (\App\Model\Product::where('id', $cartContent->id)->first()->tax)) / 100;
                    }
                }
                $grandTotal = $subTotal + $tax;
            }
        }
        if (session()->exists('coupon')) {
            $grandTotal = $grandTotal - session()->get('coupon')['discount_value'];
        }
        if (Session::has('link_id')) {

            $link_id = Session::get('link_id');
            $super_vendor_id = StoreReferralLink::where('id', $link_id)->first()->super_vendor_id;
            $product_id = StoreReferralLink::where('product_id', $cartContent->id)->first();
            if ($product_id != null && $product_id->product_id == $cartContent->id) {
                $commission = SuperVendorCommissionRate::where('user_id', $super_vendor_id)->first() ? SuperVendorCommissionRate::where('user_id', $super_vendor_id)->first()->commission_rate : '0';
                $referral = ($commission / 100 * $subTotal);
                Session::put('super_vendor_id', $super_vendor_id);
                Session::put('referral', $referral);
            }
        }
        if (Session::has('super_customer_link_id')) {

            $link_id = Session::get('super_customer_link_id');
            $super_customer_id = SuperCustomerLink::where('id', $link_id)->first()->super_customer_id;
            $product_id = SuperCustomerLink::where('product_id', $cartContent->id)->first();
            if ($product_id != null && $product_id->product_id == $cartContent->id) {
                $commission = SuperCustomerCommissionRate::where('user_id', $super_customer_id)->first() ? SuperCustomerCommissionRate::where('user_id', $super_customer_id)->first()->commission_rate : '0';
                $referral = ($commission / 100 * $subTotal);
                Session::put('super_customer_id', $super_customer_id);
                Session::put('super_customer_referral', $referral);
            }
        }


        $data['cart'] = $grandTotal;
        $data['amount'] = $amount;
        $data['grandTotal'] = number_format($grandTotal + $amount, 2);

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'shipping_address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|string|max:255',
            'country' => 'required',
            'area' => 'required',
            'district' => 'required',
            'zone' => 'required',
            'mobile' => 'required|min:9|max:15',
        ]);
        $ship_location = ShippingAmount::where('place', $request->shipping_address)->first();

        if ($ship_location == null) {
            return redirect()->back()->with('error', 'Invalid location !');
        }
        $cartContents = Cart::instance('prebooking')->content();
        try {
            $order = $this->orderRepository->update($id, $request->all());
            $code = $order->code;
        } catch (Exception $e) {
            throw new Exception('Error in updating order: ' . $e->getMessage());
        }
        $data2 = [
            'name' => $request->first_name . '  ' . $request->last_name,
            'products' => $cartContents,
            'subject' => 'Order Received',
            'ship_amount' => $ship_location->amount,

        ];

        \Mail::to(Auth::User()->email)->send(new OrderSent($data2));
        Session::flash('order', 'Saved!');
        return view('front.checkout.order_status', compact('code'));
    }
}
