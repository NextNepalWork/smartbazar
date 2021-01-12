<?php

namespace App\Http\Controllers\Vendor;
use App\Model\VendorCoverImage;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VendorRequest;
use App\Http\Requests\WithDrawRequest;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\OrderReturnRequest;
use App\Model\Product;
use App\Model\ReferralAmountSuper;
use App\Model\ReferredUserSave;
use App\Model\StoreReferralLink;
use App\Model\SuperVendorReferral;
use App\Model\VendorSignUpPayment;

use App\Model\VendorCompanyImage;
use App\Model\VendorDocument;
use App\Model\VendorWallet;
use App\Model\Wallet;
use App\VendorRating;
use App\Model\ReviewProduct;
use App\Model\Commission;
use App\Model\Vendor;
use App\Model\VendorDetail;
use App\Model\WithDraw;
use App\Model\WithdrawStatus;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\VendorRepository;
use App\User;
use App\VendorBankInfo;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use Carbon\Carbon;


class VendorController extends Controller
{
    private $vendorRepository;
    protected $register;

    public function __construct(VendorRepository $vendorRepository, RegisterController $register)
    {
        $this->vendorRepository = $vendorRepository;
        $this->register = $register;
    }

    public function getDashboard()
    {

        $vendor = User::findOrFail(auth()->id());
        $ratings = VendorRating::where('vendor_id', $vendor->id)->whereNotIn('status', ['deleted'])->count();
        $products = Product::where('user_id', $vendor->id)->whereNotIn('status', ['deleted'])->count();
        $approved = Product::where('user_id', $vendor->id)->where('approved', 1)->whereNotIn('status', ['deleted'])->count();
        $pending = Product::where('user_id', $vendor->id)->where('approved', 0)->whereNotIn('status', ['deleted'])->count();
        $reviews = ReviewProduct::whereHas('products', function ($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        })->count();
        $orders = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id);
        })->count();
        $ordersPending = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 1);
        })->count();
        $ordersApproved = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 2);
        })->count();
        $ordersReceived = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 3);
        })->count();
        $ordersDelivered = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 4);
        })->count();
        $ordersCancelled = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 5);
        })->count();
        $ordersReview = Order::whereHas('orderProduct', function ($query) use ($vendor) {
            $query->where('owner_id', $vendor->id)
                ->where('status', 6);
        })->count();
        $orderReturns = OrderReturnRequest::whereHas('orderReturnProducts', function ($query) use ($vendor) {
            $query->whereHas('order_product', function ($query) use ($vendor) {
                $query->where('owner_id', $vendor->id);
            });
        })->count();
        $orderReturnsPending = OrderReturnRequest::where('status_id', 1)->whereHas('orderReturnProducts', function ($query) use ($vendor) {
            $query->whereHas('order_product', function ($query) use ($vendor) {
                $query->where('owner_id', $vendor->id);
            });
        })->count();
        $orderReturnsApproved = OrderReturnRequest::where('status_id', 2)->whereHas('orderReturnProducts', function ($query) use ($vendor) {
            $query->whereHas('order_product', function ($query) use ($vendor) {
                $query->where('owner_id', $vendor->id);
            });
        })->count();
        $commission = Commission::where('user_id', $vendor->id)->first();
        $order_products = OrderProduct::where('owner_id', auth()->id())->where('status', 4)->get();
        // dd($order_products);
        $total_balance = 0;
        foreach ($order_products as $order) {
            // dd($order->products);
            $price = $order->price * $order->qty;
            $commission = $price * ($order->products->commission / 100);
            $total_balance += ($price - $commission);
        }

        return view('merchant.dashboard', compact('vendor', 'ratings', 'reviews', 'products', 'approved', 'pending', 'reviews',
            'commission', 'orders', 'ordersPending', 'ordersApproved', 'ordersReceived',
            'ordersDelivered', 'ordersCancelled', 'ordersReview', 'orderReturns', 'orderReturnsPending', 'orderReturnsApproved', 'total_balance'));
    }

    public function getConfiguration()
    {
        $vendor = VendorDetail::where('user_id', auth()->id())->first();
        // $request = VendorDetail::where('user_id', auth()->id())->first();
        return view('merchant.configuration.index', compact('vendor'));
    }

    public function index()
    {
        // $id = Auth::user()->id;
        // $vendor_details = VendorDetails::where('user_id',$id)->get();
        return view('merchant.vendors.index');
    }

    public function vendorDetails()
    {
        return view('merchant.vendors.index');
    }


    public function storeVendorDetails(Request $request)
    {
        try {
            $this->vendorRepository->vendorDetailsStore($request->all());
        } catch (Exception $e) {
            throw new Exception('Error in saving details: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Vendor Details Successfully Added');
    }

    public function sendVendorRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_dash|unique:vendor_details,user_id,' . auth()->id(),
            'pan_number' => 'required|integer',
            'email' => 'required|email',
            'tax_clearance' => 'required',
            'type' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'pan_image' => 'image|required',
            'company_image' => 'required|image',
            'signature_image' => 'image|required'

        ],
            [
                'name.required' => 'Store Name Already Taken',
                'name.alpha_dash' => 'Store name may contain letters and no alphabets and spaces'
            ]);
        if (VendorDetail::where('user_id', auth()->id())->count() > 0) {
            $new = VendorDetail::where('user_id', auth()->id())->first();

            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'pan_image')->count() > 0) {
                $pan_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'pan_image')->first();
            } else {
                $pan_image = new VendorDocument();
            }
            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'company_image')->count() > 0) {
                $company_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'company_image')->first();
            } else {
                $company_image = new VendorDocument();
            }
            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'signature_image')->count() > 0) {
                $signature_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'signature_image')->first();
            } else {
                $signature_image = new VendorDocument();
            }
        } else {
            $new = new VendorDetail();
            $pan_image = new VendorDocument();
            $company_image = new VendorDocument();
            $signature_image = new VendorDocument();
        }
        $new->user_id = auth()->id();
        $new->name = preg_replace('/\s+/', '', $request->name);
        $new->pan_number = $request->pan_number;
        $new->primary_email = $request->email;
        $new->type = $request->type;
        $new->tax_clearance = $request->tax_clearance;

        $new->address = $request->address;
        $new->primary_phone = $request->phone;
        $new->verified = '0';
                $new->vendor_type = $request->vendor_type;
                
        $new->vendor_code=Carbon::now()->month.rand(0,9).auth()->id().rand(0,9).Carbon::now()->day.rand(0,9);

        $new->save();

        if ($request->pan_image) {
            $pan_image->vendor_detail_id = $new->id;
            $pan_image->title = 'pan_image';
            $pan_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('pan_image')));
            $pan_image->save();
        }
        if ($request->company_image) {
            $company_image->title = 'company_image';
            $company_image->vendor_detail_id = $new->id;

            $company_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('company_image')));
            $company_image->save();
        }
        if ($request->signature_image) {
            $signature_image->title = 'signature_image';
            $signature_image->vendor_detail_id = $new->id;

            $signature_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('signature_image')));
            $signature_image->save();
        }
        
      
        if ($request->profile_picture) {
            $vendor_id = $new->id;

            if ($request->hasfile('profile_picture')) {
                $image = $request->file('profile_picture');
                $ext = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/vendor_company_image/');
                $image->move($destinationPath, $ext);
                $data['image'] = $ext;


            }
            $create = VendorCompanyImage::updateorcreate(['vendor_details_id' => $vendor_id], [
                'vendor_details_id' => $vendor_id,
                'image' => $ext
            ]);


        }
        return redirect()->route('sell.pay',$new)->with('success', 'Vendor Request SuccessFully Sent .Please Wait For Further Processing');

    }
    
    public function vendor_signup_payment(Request $request)
    {
        if ($request->isMethod('get')) {
            
   if (!VendorDetail::where('id', $request->data)->first()) {
                abort(404);
            }

            $vendor_type= VendorDetail::where('id',$request->data)->first()->vendor_type;
            if($vendor_type =='standard'){
                $amount=2000;
            }
            else{
                $amount=5000;
            }
            $vendor_code=  VendorDetail::where('id',$request->data)->first()->vendor_code;
            return view('front.signup_payment',compact('amount','vendor_code'));
        }
        return true;
    }

    public function fail(Request $request){
    return redirect()->back()->with('success', 'Your Payment was not Successful,Please try again!!');
    }
    public function success(Request $request)
    {

        $url = "https://esewa.com.np/epay/transrec";
        $data = [
            'amt' => $request->amt,
            'rid' => $request->refId,
            'pid' => $request->oid,
            'scd' => 'NP-ES-ANISHTEST'
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $items = simplexml_load_string($response);
        $json = json_encode($items);
        $check = json_decode($json, true);
        $trim = preg_replace("/[^a-zA-Z0-9]+/", "", $check['response_code']);
        if ($trim == 'Success') {
            $vendor_id = VendorDetail::where('vendor_code', $request->oid)->first();


            $vendor_id = VendorDetail::where('vendor_code', $request->oid)->first();

            if ($vendor_id->vendor_type == 'standard') {
                $amount = 2000;
            } else {
                $amount = 5000;
            }
            if ($amount == $request->amt) {
                
                $codCheck= VendorSignUpPayment::where('vendor_id',$vendor_id->id)->first();
                
                if($codCheck && $codCheck->payment_method=='COD'){
                     $codCheck= VendorSignUpPayment::where('vendor_id',$vendor_id->id)->update([
                    'vendor_id' => $vendor_id->id,
                    'amount' => $request->amt,
                    'status' => 1,
                    'payment_method' => 'esewa',
                    'ref_id' => $request->refId
                ]);
                }
                else{
                     $save = VendorSignUpPayment::create([
                    'vendor_id' => $vendor_id->id,
                    'amount' => $request->amt,
                    'status' => 1,
                    'payment_method' => 'esewa',
                    'ref_id' => $request->refId
                ]);
                if ($save) {
                    return redirect()->route('home.index')->with('success', 'Payment Successfully made with E-sewa');
                }
                }
                
                  return redirect()->route('home.index')->with('success', 'Payment Successfully made with E-sewa');
               
            } else {
                return redirect()->back()->with('success', 'Amount Do not match');
            }


        }  else {
            return redirect()->back()->with('success', 'Unathorized ,Please try again!!');
        }

        return false;
    }
    
    public function pay_vendor(Request $request){
        $pay_method= $request->pay_method;
        $vendor_code=$request->vendor_code;
        
        
          $vendor_id = VendorDetail::where('vendor_code', $vendor_code)->first();
          
          $payment_check= VendorSignUpPayment::where('vendor_id',$vendor_id->id)->first();
          if($payment_check && $payment_check->payment_method=='esewa'){
              return redirect()->back()->with('success','Payment already made with E-sewa');
          }

   $save = VendorSignUpPayment::create([
                    'vendor_id' => $vendor_id->id,
                    'amount' => 0,
                    'status' => 0,
                    'payment_method' => 'COD',
                    'ref_id' => 0
                ]);   
                
        
        if($save){
       return redirect()->route('home.index')->with('success', 'Vendor Request Sent, Please pay your registration fees');        }
    }

    public function getVendorDetails()
    {
        // $id = Auth::user()->id;
        $vendor_details = VendorDetail::all();
        return datatables($vendor_details)->toJson();
    }

    public function delete($id)
    {
        $delete = VendorDetail::findOrFail($id);
        $delete->delete();
    }

    public function editVendorDetails($id)
    {
        $vendor_details = VendorDetail::where('id', $id)->first();
        return view('merchant.vendors.edit_vendor_details', compact('vendor_details'));
    }

    public function updateVendorDetails(UserRequest $request)
    {
        $vendorDetails = VendorDetail::findOrFail($request->id);
        $vendorDetails->update($request->all());
    }

    public function viewVendorDetails($id)
    {
        $vendor_details = VendorDetail::where('id', $id)->first();
        $user_id = $vendor_details->user_id;
        $vendor_info = User::where('id', $user_id)->get();
        return view('merchant.vendors.view_vendor_details', compact('vendor_details', 'vendor_info'));
    }

    public function getWithdraw()
    {
        $orders = OrderProduct::where('owner_id', auth()->id())->where('status', 4)->get();
        $total_balance = 0;
        $total_commission = 0;
        $tax = 0;
        foreach ($orders as $order) {
            $price = $order->price * $order->qty;
            $tax += $price * ($order->tax / 100);
            $commission = $price * ($order->products->commission / 100);
            $total_commission += $commission;
            $total_balance += ($price - $commission);
        }

        $total_withdraws = Withdraw::where('vendor_id', auth()->id())->where('status', 2)->pluck('amount');
        $total_withdraw = 0;
        foreach ($total_withdraws as $withdraw) {
            $total_withdraw += $withdraw;
        }
        $last_withdraw = Withdraw::where('vendor_id', auth()->id())->where('status', 2)->orderBy('id', 'DESC')->first();
        $withdraws = WithDraw::where('vendor_id', auth()->id())->get();
        return view('merchant.withdraw.index', compact('withdraws', 'total_balance', 'total_withdraw', 'last_withdraw', 'total_commission', 'tax'));
    }

    public function getWithdrawRequest()
    {   
        $vendor_id = auth()->id();
        $details = WithDraw::where('vendor_id', $vendor_id)->get();
        return view('merchant.withdraw.create', compact('details'));
    }

 public function getWithdrawStore(WithDrawRequest $request)
    {
        $withdraw_status = WithdrawStatus::where('is_default', 1)->first()->id;

        $withdraw = new WithDraw;

        $withdraw->vendor_id = auth()->id();
        $withdraw->method = $request->method;
        $withdraw->amount = $request->amount;
        $withdraw->approve = $request->approve;
        $withdraw->email = $request->email;
        $withdraw->account_no = $request->account_no;
        $withdraw->account_name = $request->account_name;
        $withdraw->account_address = $request->account_address;
        $withdraw->additional_references = $request->reference;
        $withdraw->status = $withdraw_status;

        $withdraw->save();

        Session::flash('success', "Withdraw Request Received");

        return redirect()->back();
    }

    public function getEdit($id)
    {

        $withDrawStatus = WithdrawStatus::all();
        $details = WithDraw::findOrFail($id);
        return view('merchant.withdraw.edit', compact('details', 'withDrawStatus'));
    }

    public function getWithdrawAccount()
    {
        $vendor_id = auth()->id();
        $details = WithDraw::where('vendor_id', $vendor_id)->get();
        return view('merchant.withdraw.use', compact('details'));
    }


    public function getWithdrawUse($id)
    {
        $details = WithDraw::findOrFail($id);
        return view('merchant.withdraw.use-create', compact('details'));

    }

    public function getWithdrawCancel($id)
    {
        $withdraw = WithDraw::findorfail($id);
        if ($withdraw->status == 1) {
            $withdraw->status = 3;
            $withdraw->update();
            return redirect()->back()->with('success', 'Your Withdraw Has been Canceled');
        } else
            return redirect()->back()->with('error', 'Something Went Wrong !!');

    }

    public function getVendorProfile($id)
    {
        $user = Auth::user();
        return view('merchant.vendor_profile', compact('user'));
    }

    public function company_image(Request $request)
    {
        $request->validate([
            'company_image' => 'required|image'
        ]);
        $vendor_id = VendorDetail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first()->id;

        if ($request->hasfile('company_image')) {
            $this->delete_company_image($vendor_id);
            $image = $request->file('company_image');
            $ext = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/vendor_company_image/');
            $image->move($destinationPath, $ext);
            $data['image'] = $ext;


        }
        $create = VendorCompanyImage::updateorcreate(['vendor_details_id' => $vendor_id], [
            'vendor_details_id' => $vendor_id,
            'image' => $ext
        ]);
        if ($create) {
            return redirect()->back()->with('success', 'Updated');
        }
        return false;
    }

    public function delete_company_image($id)
    {
        $findata = VendorCompanyImage::where('vendor_details_id', $id)->first();
        if ($findata) {
            $image = $findata->image;

            $deletepath = public_path('/vendor_company_image/' . $image);
            if (file_exists($deletepath) && is_file($deletepath)) {
                unlink($deletepath);
            }
        }
    }

    public function cover_image(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image'
        ]);
        $vendor_id = VendorDetail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first()->id;

        if ($request->hasfile('cover_image')) {
            $this->delete_cover_image($vendor_id);
            $image = $request->file('cover_image');
            $ext = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/vendor_cover_image/');
            $image->move($destinationPath, $ext);
            $data['image'] = $ext;


        }
        $create = VendorCoverImage::updateorcreate(['vendor_details_id' => $vendor_id], [
        'vendor_details_id' => $vendor_id,
        'cover_image' => $ext
    ]);
        if ($create) {
            return redirect()->back()->with('success', 'Updated');
        }
        return false;    }

    public function delete_cover_image($id)
    {
        $findata = VendorCoverImage::where('vendor_details_id', $id)->first();
        if ($findata) {
            $image = $findata->cover_image;

            $deletepath = public_path('/vendor_cover_image/' . $image);
            if (file_exists($deletepath) && is_file($deletepath)) {
                unlink($deletepath);
            }
        }
    }

    public function add_vendor(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('merchant.add_vendor');
        }
        if ($request->isMethod('post')) {
            {
                $registerfirst = $this->register->register_through_supervendor($request);

                if ($registerfirst) {
                    if (\Illuminate\Support\Facades\Session::has('through_superAdmin')) {
                        $user_id = \Illuminate\Support\Facades\Session::get('through_superAdmin');
                        $validator = Validator::make($request->all(), [
                            'name' => 'required|alpha_dash|unique:vendor_details,user_id,' . $user_id,
                            'pan_number' => 'required|integer',
                            'email' => 'required|email',
                            'tax_clearance' => 'required',
                            'type' => 'required',
                            'address' => 'required',
                            'phone' => 'required',
                            'pan_image' => 'image|required',
                            'company_image' => 'required|image',
                            'signature_image' => 'required|image'
                        ]);

                        if ($validator->fails()) {
                            User::where('id', $user_id)->delete();
                        }

                        if (VendorDetail::where('user_id', $user_id)->count() > 0) {
                            $new = VendorDetail::where('user_id', $user_id)->first();

                            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'pan_image')->count() > 0) {
                                $pan_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'pan_image')->first();
                            } else {
                                $pan_image = new VendorDocument();
                            }
                            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'company_image')->count() > 0) {
                                $company_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'company_image')->first();
                            } else {
                                $company_image = new VendorDocument();
                            }
                            if (VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'signature_image')->count() > 0) {
                                $signature_image = VendorDocument::where('vendor_detail_id', $new->id)->where('title', 'signature_image')->first();
                            } else {
                                $signature_image = new VendorDocument();
                            }
                        } else {
                            $new = new VendorDetail();
                            $pan_image = new VendorDocument();
                            $company_image = new VendorDocument();
                            $signature_image = new VendorDocument();
                        }
                        $new->user_id = $user_id;
                        $new->name = preg_replace('/\s+/', '', $request->name);
                        $new->pan_number = $request->pan_number;
                        $new->primary_email = $request->email;
                        $new->type = $request->type;
                        $new->tax_clearance = $request->tax_clearance;

                        $new->address = $request->address;
                        $new->primary_phone = $request->phone;
                        $new->verified = '0';
                                       $new->vendor_type = $request->vendor_type;
                
        $new->vendor_code=Carbon::now()->month.rand(0,9).auth()->id().rand(0,9).Carbon::now()->day.rand(0,9);
                        $new->save();

                        if ($request->pan_image) {
                            $pan_image->vendor_detail_id = $new->id;
                            $pan_image->title = 'pan_image';
                            $pan_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('pan_image')));
                            $pan_image->save();
                        }
                        if ($request->company_image) {
                            $company_image->title = 'company_image';
                            $company_image->vendor_detail_id = $new->id;

                            $company_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('company_image')));
                            $company_image->save();
                        }
                        if ($request->signature_image) {
                            $signature_image->title = 'signature_image';
                            $signature_image->vendor_detail_id = $new->id;

                            $signature_image->image = 'data:image/jpeg/png/gif;base64,' . base64_encode(file_get_contents($request->file('signature_image')));
                            $signature_image->save();
                        }
                        if (\Illuminate\Support\Facades\Session::has('through_superAdmin')) {
                            $referral = SuperVendorReferral::create([
                                'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
                                'referral_id' => $user_id
                            ]);


                        }
                        

                        return redirect()->back()->with('success', 'Vendor Request SucessFully Sent , Wait for Confirmation');
                    }
                } else {
                    return redirect()->back()->with('error', 'Error Creating Vendor');
                }

            }
        }

        return false;
    }

    public function all_referral(Request $request)
    {
        if ($request->isMethod('get')) {
            $superReferral = SuperVendorReferral::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
            return view('merchant.all_referral', compact('superReferral'));
        }

        return false;
    }

    public function referral_link(Request $request)
    {
        if ($request->isMethod('get')) {
            $referrableProduct = Product::where('user_id', 1)->where('status', 1)->get();
            $created_links = StoreReferralLink::where('super_vendor_id', \Illuminate\Support\Facades\Auth::id())->get();
            return view('merchant.referral_link', compact('created_links', 'referrableProduct'));

        }
        if ($request->isMethod('post')) {
            $request->validate([
                'referral_link' => 'required'

            ]);
            $link = $request->referral_link;
            $token = time() . str_random();
            $product_slug = substr($link, strrpos($link, '/') + 1);
            if (!Product::where('slug', $product_slug)->first()->where('user_id', 1)) {
                return redirect()->back()->with('success', 'Reference Link Doesnot Match');
            }
            $product_id = Product::where('slug', $product_slug)->first()->id;

            $create = StoreReferralLink::create([
                'product_link' => $link,
                'token' => $token,
                'super_vendor_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'refer_link' => url('storereferral_link/') . '/' . $token,
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
        $check = StoreReferralLink::where('token', $token)->first();

        if ($check) {
            $destory_cart = Cart::destroy();

            if (!\Illuminate\Support\Facades\Auth::check()) {
                return redirect()->route('login')->with('error', 'Login first and try with referral Link');
            }
            $doublecheck = ReferredUserSave::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('links_id', $check->id)->first();
            if ($doublecheck) {
                if ($doublecheck->times > 3) {
                    return redirect()->route('home')->with('error', 'Link Limit Reached');
                }


                ReferredUserSave::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('links_id', $check->id)->update(['times' => $doublecheck->times + 1]);
                \Illuminate\Support\Facades\Session::put('link_id', $check->id);

                return redirect()->to($check->product_link);

            } else {

                $Referusersave = ReferredUserSave::updateorcreate(['user_id' => \Illuminate\Support\Facades\Auth::user()->id, 'links_id' => $check->id,], [
                    'status' => '0',
                    'times' => '1'
                ]);
                if ($Referusersave) {
                    \Illuminate\Support\Facades\Session::put('link_id', $check->id);

                    return redirect()->to($check->product_link);

                }
            }


        } else {
            return redirect()->route('home')->with('error', 'Referral Link Doesnot Match');
        }

    }

    public function wallet(Request $request)
    {
        if ($request->isMethod('get')) {
            $walletcheck = VendorWallet::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
            if ($walletcheck == null) {
                $create_wallet = VendorWallet::create([
                    'super_vendor_id' => \Illuminate\Support\Facades\Auth::user()->id,
                    'total_amount' => 0
                ]);
                $wallet = VendorWallet::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
                $transaction = ReferralAmountSuper::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->get();

            } else {
                $wallet = VendorWallet::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
                $from_vendor_referral = $this->from_vendor_referral();
                $from_store_referral = $this->from_store_referral();
                $totalamount = $from_vendor_referral + $from_store_referral;

                $save = VendorWallet::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->update(['total_amount' => $totalamount]);
                $transaction = ReferralAmountSuper::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->get();


            }
            return view('merchant.wallet', compact('wallet', 'transaction'));
        }
        return false;
    }

    public function from_vendor_referral()
    {
        $refercommission = SuperVendorReferral::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        if ($refercommission->isnotEmpty()) {
            foreach ($refercommission as $value) {
                $total_commission[] = getConfiguration('global_vendor_commission') ? getConfiguration('global_vendor_commission') : 0;
            }
            if (isset($total_commission) && !empty($total_commission)) {
                $total_commission_amount = array_sum($total_commission);
                return $total_commission_amount;
            } else return 0;


        }
        return 0;
    }

    public function from_store_referral()
    {
        $transaction = ReferralAmountSuper::where('super_vendor_id', \Illuminate\Support\Facades\Auth::user()->id)->get();

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
