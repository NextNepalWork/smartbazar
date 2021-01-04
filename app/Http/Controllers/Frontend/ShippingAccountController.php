<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAccountRequest;
use App\Http\Requests\UserInfoRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Model\MainShipping;
use App\Model\Negotaible;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\OrderReturnRequest;
use App\Model\Product;
use App\Model\ProductAdditional;
use App\Model\Referral;
use App\Model\ReferredUserSuperCustomer;
use App\Model\ShippingAccount;
use App\Model\SuperCustomerAmount;
use App\Model\SuperCustomerLink;
use App\Model\SuperCustomerWallet;
use App\Model\Wishlist;
use App\Repositories\Contracts\OrderRepository;
use App\User;
use App\User_info;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ShippingAccountController extends Controller
{
    private $order;

    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function getIndex()
    {
        $user = auth()->id();
        $verified = User::find($user)->verified;
        $orders = Order::where('user_id', '=', $user)->orderBy('id', 'DESC')->get();
        $prebookingOrders = Order::whereHas('prebookings', function ($query) {
            $query->where('status', 0);
        })->where('user_id', $user)->get();
        $user_info = User_info::where('user_id', auth()->id())->first();
        $shipping = ShippingAccount::where('user_id', auth()->id())->get();
        $order_returns = OrderReturnRequest::where('user_id', auth()->id())->get();
        $nego_topic = Negotaible::where('user_id', $user)->get();
        $wishlists = Wishlist::where('user_id', $user)->get();
        $used_add = ShippingAccount::where('is_default', 1)->where('user_id', auth()->id())->first();
        $referrals = Referral::where('user_id', auth()->id())->get();
        $all_products = Product::where('status', 1)->get();
        $super_links = SuperCustomerLink::where('super_customer_id', Auth::user()->id)->get();

        //---------wallet--------//

        $walletcheck = SuperCustomerWallet::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
        if ($walletcheck == null) {
            $create_wallet = SuperCustomerWallet::create([
                'super_customer_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'total_amount' => 0
            ]);
            $wallet = SuperCustomerWallet::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
            $transaction = SuperCustomerAmount::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->get();

        } else {
            $wallet = SuperCustomerWallet::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
            $total = $this->total_wallet();
            $totalamount = $total;
            $save = SuperCustomerWallet::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->update(['total_amount' => $totalamount]);
            $transaction = SuperCustomerAmount::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->get();


        }
        if (isset($transaction) && $wallet) {
            return view('front.my_account.index', compact('user_info', 'shipping', 'orders', 'order_returns', 'nego_topic', 'wishlists', 'used_add', 'verified', 'referrals', 'prebookingOrders', 'all_products', 'super_links', 'transaction', 'wallet'));

        }

        return view('front.my_account.index', compact('user_info', 'shipping', 'orders', 'order_returns', 'nego_topic', 'wishlists', 'used_add', 'verified', 'referrals', 'prebookingOrders', 'all_products', 'super_links'));
    }

    public function postShippingStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'area' => 'required|max:255',
            'district' => 'required|max:255',
            'zone' => 'required|max:255',
            'mobile' => 'required|min:9|max:15',
        ]);

        $shipping = new ShippingAccount();
        $shipping->user_id = auth()->id();
        $shipping->first_name = $request->first_name;
        $shipping->last_name = $request->last_name;
        $shipping->email = $request->email;
        $shipping->country = $request->country;
        $shipping->zone = $request->zone;
        $shipping->area = $request->area;
        $shipping->district = $request->district;
        $shipping->location_type = $request->location_type;
        $shipping->mobile = $request->mobile;
        $shipping->phone = $request->phone;
        $shipping->save();

        Session::flash('success', "New Address is successfully Saved!");

        return redirect()->back();
    }

    public function postShippingEdit($id)
    {

        $shipping = ShippingAccount::find($id);
        return view('front.my_account.edit_shipping_account', compact('shipping'));


    }

    public function updateShipping($id, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'area' => 'required|max:255',
            'district' => 'required|max:255',
            'zone' => 'required|max:255',
            'mobile' => 'required|min:9|max:15',
        ]);

        $shipping = ShippingAccount::findOrFail($id);
        $shipping->user_id = auth()->id();
        $shipping->first_name = $request->first_name;
        $shipping->last_name = $request->last_name;
        $shipping->email = $request->email;
        $shipping->country = $request->country;
        $shipping->zone = $request->zone;
        $shipping->area = $request->area;
        $shipping->district = $request->district;
        $shipping->location_type = $request->location_type;
        $shipping->mobile = $request->mobile;
        $shipping->phone = $request->phone;
        $shipping->update();

        Session::flash('success', "Your Address is successfullyuUpdated!");

        return redirect()->route('user.account');
    }

    public function postShippingDelete($id)
    {

        $shipping = ShippingAccount::find($id);
        if (Order::where('address_id', $shipping->id)->exists()) {
            return redirect()->back()->with('error', 'Your Address is being used in your order!');
        }

        $shipping->delete();

        Session::flash('success', "Your Address is successfully deleted!");

        return redirect()->back();
    }

    public function postInfoStore(UserInfoRequest $request)
    {
        if ($request->hasFile('user_image')) {
            if (isset(User_info::where('user_id', auth()->id())->first()->image)) {
                $existFile = User_info::where('user_id', auth()->id())->first()->image;
                Storage::disk('public')->delete($existFile);
            }
            $image = $request->file('user_image');
            $filename = time() . $image->getClientOriginalName();
            Storage::disk('public')->putFileAs('storage/user_avatar', $image, $filename);
            $request->request->add(['image' => 'user_avatar' . '/' . $filename]);
        }

        $request->request->add(['user_id' => auth()->id()]);

        $user_info = User_info::updateOrCreate(['user_id' => auth()->id()], $request->all());

        Session::flash('success', 'Personal Info Updated!');

        return redirect()->back();
    }

    public function postUserStore(UserPasswordRequest $request)
    {
        $user = Auth::User();
        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->update(['password' => bcrypt($request->input('password'))]);

            return redirect()->back()->with('success', 'Password Changed Successfully!');
        } else {
            return redirect()->back()->with('error', 'Your current password is wrong!');
        }
    }

    public function cancelOrder($id)
    {
        $order = $this->order->find($id);

        if ($order->order_status_id != 1 && $order->order_status_id != 5) {
            $pid = DB::table('order_product')->where('order_id', $id)->get();
            foreach ($pid as $pid) {
                $product = Product::where('id', $pid->product_id)->first();
                $product->stock_quantity = (int)($product->stock_quantity) + (int)($pid->qty);
                $product->update();
                if (isset($product->additionals) && $product->additionals->isNotEmpty()) {
                    $size = OrderProduct::where('order_id', $order->id)->where('product_id', $product->id)->first()->size;
                    $additional = ProductAdditional::where('product_id', $pid)->where('size', $size)->first();
                    $additional->quantity = (int)($additional->quantity) + (int)($qty);
                    $additional->update();
                }
            }
        }

        $order->update(['order_status_id' => 5]);

        return redirect()->back()->with('success', 'Your Order has been Cancelled!');
    }

    public function viewOrderDetails($id)
    {
        $order = Order::findOrFail($id);
        return view('front.my_account.order_details', compact('order'));
    }

    public function myWishlist()
    {
        return view('front.cart.wishlist');
    }

    public function wishlist($product_id)
    {

        $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', auth()->id())->first();
        if ($wishlist) {
            return redirect()->back()->with('error', 'Item already in Wishlist');

        }
        $new = new Wishlist();
        $new->product_id = $product_id;
        $new->user_id = auth()->id();
        $new->save();

        return redirect()->route('user.account')->with('success', 'Wishlist has been Updated');

    }

    public function wishlistDestory($id)
    {

        $wishlist = Wishlist::find($id);
        if ($wishlist->delete()) {
            return redirect()->back()->with('success', 'Wishlist has been Deleted');
        }
        return redirect()->back()->with('error', 'Error occured while Deleting');
    }

    public function accountInfoStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'user_name' => 'required|string|max:50|unique:users,user_name,' . auth()->id(),
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = User::findOrFail(auth()->id());

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->update();

        return redirect()->back()->with('success', 'Account Info Successfully Updated');
    }

    public function useAddress(Request $request)
    {
        $add = ShippingAccount::where('is_default', 1)->where('user_id', auth()->id())->first();
        if (!empty($add) && $add->id == $request->id) {
            $add->is_default = 0;
            $add->update();
            return $request->id;
        }
        if (!empty($add)) {
            $add->is_default = 0;
            $add->update();
        }
        $used = ShippingAccount::findOrFail($request->id);
        $used->is_default = 1;
        $used->update();

        return $request->id;
    }

    public function referral(Request $request)
    {
        if ($request->isMethod('get')) {
            $all_products = Product::all();
            return view('front.my_account.index', compact('all_products'));

        }
        if ($request->isMethod('post')) {
            $request->validate([
                'referral_link' => 'required'

            ]);
            $link = $request->referral_link;
            $token = time() . str_random();
            $product_slug = substr($link, strrpos($link, '/') + 1);
            $product_id = Product::where('slug', $product_slug)->first()->id;

            $create = SuperCustomerLink::create([
                'product_link' => $link,
                'token' => $token,
                'super_customer_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'refer_link' => url('product_link/') . '/' . $token,
                'product_id' => $product_id
            ]);

            if ($create) {
                return redirect()->back()->with('success', 'Links Created');
            }
        }
        return false;
    }

    public function referral_link_click(Request $request)
    {
        $token = $request->token;
        $check = SuperCustomerLink::where('token', $token)->first();

        if ($check) {
            $destory_cart = \Gloudemans\Shoppingcart\Facades\Cart::destroy();

            if (!\Illuminate\Support\Facades\Auth::check()) {
                return redirect()->route('login')->with('error', 'Login first and try with referral Link Again');
            }
            $doublecheck = ReferredUserSuperCustomer::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('links_id', $check->id)->first();
            if ($doublecheck) {
                if ($doublecheck->times > 3) {
                    return redirect()->route('home')->with('error', 'Link Limit Reached');
                }


                ReferredUserSuperCustomer::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('links_id', $check->id)->update(['times' => $doublecheck->times + 1]);
                \Illuminate\Support\Facades\Session::put('super_customer_link_id', $check->id);

                return redirect()->to($check->product_link);

            } else {

                $Referusersave = ReferredUserSuperCustomer::updateorcreate(['user_id' => \Illuminate\Support\Facades\Auth::user()->id, 'links_id' => $check->id,], [
                    'status' => '0',
                    'times' => '1'
                ]);
                if ($Referusersave) {
                    \Illuminate\Support\Facades\Session::put('super_customer_link_id', $check->id);

                    return redirect()->to($check->product_link);

                }
            }


        } else {
            return redirect()->route('home')->with('error', 'Referral Link Doesnot Match');
        }
        return false;

    }

    public function total_wallet()
    {
        $transaction = SuperCustomerAmount::where('super_customer_id', \Illuminate\Support\Facades\Auth::user()->id)->get();

        if ($transaction->isnotEmpty()) {
            foreach ($transaction as $value) {
                if ($value->status == '2') {
                    $total[] = $value->amount;
                } else {
                    $total[] = 0;
                }
            }
            if (isset($total) && !empty($total)) {
                $totalwallet = array_sum($total);
                return $totalwallet;
            }

        }
        return 0;
    }


}
