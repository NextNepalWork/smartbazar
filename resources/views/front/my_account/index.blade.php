@extends('layouts.app')
@section('title',"My Account")
@section('extra_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection
@section('content')
    @include('front.partials.models._edit_user_info')

    <section class="content-box-row">
        <div class="container " style="margin:10px auto;padding:0;">
            @if(isset($verified))
                @if($verified==0)
                    <div class="notify">
                        <div id="notif-messages" class="alert alert-warning" style="display: block;">
                            <span class="icon-circle-check mr-2"></span>
                            <i class="fa fa-info-circle "></i> You Have not activated your Account!!! <a href="{{ route('resend.mail', auth()->id()) }}">Click here</a>
                            to resend email
                        </div>
                    </div>
                @endif
            @endif
            
 @if(\App\Model\VendorDetail::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first())
                @php
                    $vendor_id=\App\Model\VendorDetail::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()->id;
                @endphp
                @if(!\App\Model\VendorSignUpPayment::where('vendor_id',$vendor_id)->first() )

                    <div class="notify">
                        <div id="notif-messages" class="alert alert-warning" style="display: block;">
                            <span class="icon-circle-check mr-2"></span>
                            <i class="fa fa-info-circle "></i> Please Pay Your Registration Fees <a href="{{ route('sell.pay', $vendor_id) }}">Click here</a>
                            to Pay
                        </div>
                    </div>
                @elseif(\App\Model\VendorSignUpPayment::where('vendor_id',$vendor_id)->first() && \App\Model\VendorSignUpPayment::where('vendor_id',$vendor_id)->first()->payment_method=='COD' && \App\Model\VendorSignUpPayment::where('vendor_id',$vendor_id)->first()->status==0)
                    <div class="notify">
                        <div id="notif-messages" class="alert alert-warning" style="display: block;">
                            <span class="icon-circle-check mr-2"></span>
                            <i class="fa fa-info-circle "></i> Please pay Via Esewa or Pay with to our Doorstep <a href="{{ route('sell.pay', $vendor_id) }}">Click here</a>
                            to Pay
                        </div>
                    </div>
                @endif
            @endif
         

            <div class="accountpage content-wrap ">
                <div class="main container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 ">
                            <aside id="primary-sidebar" class="">

                                <div class="block block-account">
                                    <div class="block-title txt-dark">
                                        <i class="far fa-user-circle"
                                           style="font-size: 24px;margin-right: 10px;"></i><strong>My
                                            Account </strong>
                                        <br>
                                                                 
                                    </div>

                                    <div class="block-content" id="dashboard-nav">
                                        <div class="">

                                            <ul class="uk-tab-left nav nav-tabs  scrollbar " uk-tab role="tablist">
                                                <li class="nav-item"><a class=" " href="#my-account" role="tab"
                                                                        data-toggle="tab">Account
                                                        Information</a></li>

                                                <li class="nav-item"><a class=" " href="#my_orders" role="tab"
                                                                        data-toggle="tab">My
                                                        Orders</a></li>
                                                <li class="nav-item"><a class=" " href="#my_wishlist" role="tab"
                                                                        data-toggle="tab">My
                                                        Wishlist</a></li>
                                                <li class="nav-item "><a class=" " href="#negotiable" role="tab"
                                                                         data-toggle="tab">Negotiable</a></li>

                                                @if(\Illuminate\Support\Facades\Auth::check() && Auth::user()->roles->first() != null && \Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Super-Customer')
                                                    <li class="nav-item"><a class=" " href="#my_referral" role="tab"
                                                                            data-toggle="tab">Product
                                                            Referrals</a></li>
                                                    <li class="nav-item"><a class=" " href="#my_wallet" role="tab"
                                                                            data-toggle="tab">Wallet & My
                                                            Referrals</a></li>

                                                @endif


                                            </ul>
  @if(\Illuminate\Support\Facades\Auth::check() && Auth::user()->roles->isnotEmpty() && Auth::user()->roles->first() != null )
                                            @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name =='vendor' || \Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Super-Vendor')

                                        <i class="far fa-user-circle"
                                           style="font-size: 24px;margin-right: 10px;"></i><a
                                                href="{{ route('vendor.dashboard') }}">Go To
                                                Dashboard</a>
                                        @endif
                                        @endif

                                            <div class="become_seller"><a onclick="window.open(this.href,'_blank');return false;" class="link" href="{{route('sell.index')}}" >Become
                                                    Seller</a></div>

                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-9 col-md-9 mt-3">
                            <main class="tab-content" id="primary-content " role="tabpanel">
                                <div class="tab-pane  fade in show active" id="my-account">
                                    <div class="dashboard">
                                        <div class="heading mb text-center">
                                            <h3>Dashboard</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class=" card panel-section mb">

                                                    <div class="card-header ">
                                                        <strong class=" ">Contact Information</strong>
                                                        {{--<a class="link" href="">Edit</a>--}}

                                                    </div>
                                                    <div class="card-body">
                                                <span class="para">
                                                   {{ Auth::User()->user_name }}<br>
                                                    {{ Auth::User()->email }}<br>
                                                    <li><a class="link" href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#change_password">Change Password</a>
                                                </li>

                                                </span>
                                                    </div>

                                                </div>
                                                <!-- END card / PANEL SECTION -->
                                            </div>
                                            <div class="col-md-8">
                                                <div class=" card panel-section mb">
                                                    <div class="card-header ">
                                                        <strong class=" ">Address Setting</strong>

                                                    </div>
                                                    <div class="card-body">

                                                        <div class="container address__container tabcontent"
                                                             id="address">
                                                            {{-- shipping_form --}}
                                                            @include('front.my_account.shipping_address')
                                                            <div id="edit_address_shipping" class="modal fade"
                                                                 tabindex="-1"
                                                                 role="dialog"
                                                                 aria-labelledby="myModalLabel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END PANEL -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane  fade  " id="my_orders">
                                    <div class="container box-shadow mt-2 mb">
                                        <div class="heading mb text-center">
                                            <h3>Order Summary </h3>

                                        </div>

                                        <h3>My Orders</h3>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-condensed" id="usersOrderTable">
                                                <thead>
                                                <tr>
                                                    <th>ORDERS#</th>
                                                    <th>DATE</th>
                                                    <th>ORDER TOTAL</th>
                                                    <th>ORDER STATUS</th>
                                                    <th>Live Tracking</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    @if(empty($order->prebookings) || (isset($order->prebookings) && $order->prebookings->status == 1))
                                                        <tr>
                                                            <td>{{$order->id}}</td>
                                                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('F j, Y')}}</td>

                                                            <td>
                                                                @php
                                                                    $priceTotal = 0.00;
                                                                    $tax = 0.00;
                                                                    $discount = 0.00;
                                                                    foreach ($order->products as $product){
                                                                        $actualPrice = $product->sale_price * $product->pivot->qty;
                                                                        if($product->pivot->prebooking == 1) {
                                                                            $priceTotal += ($actualPrice * 10) / 100;
                                                                            $tax += 0;
                                                                        }
                                                                        else {
                                                                            $priceTotal += $actualPrice;
                                                                            $tax += ($actualPrice * $product->tax) / 100;
                                                                        }
                                                                        $discount += $product->pivot->discount;
                                                                    }

                                                                    $subTotal = $priceTotal;
                                                                    $grandTotal = $subTotal + $tax + $order->shipping_amount - $discount;
                                                                @endphp
                                                                Rs. {{ number_format($grandTotal, 2) }} for
                                                                <strong>{{ count($order->products) }}</strong> Products
                                                            </td>
                                                            <td>
                                                                <span class="label label-{{ getOrderStatusClass($order->orderStatus->name) }}">{{$order->orderStatus->name}}</span>
                                                            </td>
                                                            <td>{{$order->code}}</td>
                                                            <td class="text-center">
                                                                <a href="{{route('my-account.order-details', $order->id)}}"
                                                                   class="btn btn-warning btn-sm mb-1">
                                                                    <!--<span class="fa fa-eye text-warning"></span> -->
                                                                    view</a>
                                                                @if($order->orderStatus->name == 'pending')
                                                                    <a href="{{ route('my-account.order.cancel',$order->id)}}"
                                                                       class="btn btn-sm btn-danger"
                                                                       onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @if(count($prebookingOrders) > 0)
                                            <h3>My Prebookings</h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-condensed"
                                                       id="usersPreOrderTable">
                                                    <thead>
                                                    <tr>
                                                        <th>ORDERS#</th>
                                                        <th>DATE</th>
                                                        <th>ORDER TOTAL</th>
                                                        <th>ORDER STATUS</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $order)
                                                        @if(!empty($order->prebookings) && $order->prebookings->status == 0)
                                                            <tr>
                                                                <td>{{$order->id}}</td>
                                                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('F j, Y')}}</td>

                                                                <td>
                                                                    Rs. {{ number_format($order->prebookings->price, 2) }}
                                                                    for
                                                                    <strong>{{ count($order->products) }}</strong>
                                                                    Products
                                                                </td>
                                                                <td>
                                                                    <span class="label label-{{ getOrderStatusClass($order->orderStatus->name) }}">{{$order->orderStatus->name}}</span>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-info btn-xs buyprebooking"
                                                                            data-product="{{ $order->prebookings->product_id }}"
                                                                            data-order="{{ $order->id }}"
                                                                            @if(App\Model\Product::where('id', $order->prebookings->product_id)->first()->prebooking == 1) disabled @endif>
                                                                        Buy Now
                                                                    </button>
                                                                    @if($order->orderStatus->name == 'pending')
                                                                        <a href="{{ route('my-account.order.cancel',$order->id)}}"
                                                                           class="btn btn-xs btn-danger"
                                                                           onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                        @endif

                                        @if($order_returns->isNotEmpty())
                                            <h3>Return Orders</h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-condensed"
                                                       id="usersOrderReturnTable">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>Qty</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_returns as $order_return)
                                                        <tr>
                                                            <td>{{ $order_return->orderReturnProducts->first()->order_product->order_id }}</td>
                                                            <td>{{ $order_return->orderReturnProducts->first()->order_product->products->name }}</td>
                                                            <td>{{ $order_return->orderReturnProducts->first()->qty }}</td>
                                                            <td>
                                                                <span class="label label-{{ getOrderReturnStatusClass($order_return->orderReturnStatus->name) }}">{{ $order_return->orderReturnStatus->name }}</span>
                                                            </td>
                                                            <td>{{ humanizeDate($order_return->created_at) }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="tab-pane  fade " id="my_wishlist">
                                    <section id="shopping-cart">
                                        <div class="container box-shadow mt-2 mb">
                                            <div class="heading text-center mb">
                                                <h3>Wish list </h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="wishlistTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Product Image</th>
                                                        <th>Product Name</th>
                                                        <th>Product Price</th>
                                                        <th>Sale Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($wishlists as $wishlist)
                                                        <tr>
                                                            <td style="width:100px;">
                                                                <div class="wishlist-product-img">
                                                                    <a href="">
                                                                        <img src="{{$wishlist->product->getImageAttribute()->mediumUrl}}"
                                                                             alt="">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="/product/{{ $wishlist->product->slug }}"
                                                                   class="link"
                                                                   style="text-transform: capitalize;">{{$wishlist->product->name}}</a>
                                                            </td>
                                                            <td class="price__container">
                                                                <span class="price">Rs. {{$wishlist->product->product_price}}</span>
                                                            </td>
                                                            <td>
                                                                <span class="price">Rs. {{$wishlist->product->sale_price}}</span>
                                                            </td>
                                                            <td  class="text-center">
                                                                <a class="btn btn-warning btn-sm button__buynow__link buynow"
                                                                   href="{{ route('product.show', $wishlist->product->slug) }}">
                                                                    <span>Buy Now</span></a>
                                                                <a class="btn btn-danger btn-sm btnMenu request"
                                                                   href="{{ route('wishlist.delete',$wishlist->id) }}">Remove</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane  fade " id="negotiable">
                                    <section id="shopping-cart">
                                        <div class="container box-shadow mt-2 mb">
                                            <div class="heading text-center mb">
                                                <h3>Wish list </h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Product Image</th>
                                                        <th>Name</th>
                                                        <th>Sales Price</th>
                                                        <th>Negotiable Price</th>
                                                        <th>Checkout</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($nego_topic as $nego_product)
                                                        <tr>
                                                            <td style="width:100px;">
                                                                <div class="wishlist-product-img">
                                                                    <a href="">
                                                                        <img src="{{$nego_product->product->getImageAttribute()->mediumUrl}}"
                                                                             alt="">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="price"><a
                                                                            href="/product/{{ $nego_product->product->slug }}"
                                                                            class="link">{{$nego_product->product->name}}</a></span>
                                                            </td>
                                                            <td>
                                                                <span class="price">{{$nego_product->product->sale_price}}</span>
                                                            </td>
                                                            <td>
                                                                @if($nego_product->fixed_price == null)

                                                                    <span class="price" style="color: #ccc">yet not fixed</span>
                                                                @else
                                                                    <span>
                                                  {{ $nego_product->fixed_price }}
                                                </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('negoiate.checkout',$nego_product->id)}}"
                                                                   class="btn btn-primary request"
                                                                   @if($nego_product->fixed_price ==null) disabled @endif>Checkout</a>

                                                            </td>


                                                            <td class="text-center">
                                                                <a class="btn btn-warning btn-sm btnMenu mb-1 request"
                                                                   href="{{ route('negotiate.chat',$nego_product->id) }}">Negotiate</a>

                                                                <a class="btn btn-danger btn-sm btnMenu request"
                                                                   href="{{ route('negotiate.delete',$nego_product->id) }}">Remove</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{--{{ $nego_topic->links() }}--}}
                                                    {{--<div id="negotiable_chat" class="modal fade in" tabindex="-1"--}}
                                                    {{--role="dialog"--}}
                                                    {{--aria-labelledby="myModalLabel"--}}
                                                    {{--style="display: none; padding-left: 0px;">--}}
                                                    {{--<div class="modal-dialog" role="document">--}}
                                                    {{--<div class="modal-content">--}}
                                                    {{--<div class="modal-header" style="display: block;">--}}
                                                    {{--<button type="button" class="close"--}}
                                                    {{--data-dismiss="modal"--}}
                                                    {{--aria-label="Close"><span aria-hidden="true">×</span>--}}
                                                    {{--</button>--}}
                                                    {{--<h4 class="modal-title" id="myModalLabel">Samsung--}}
                                                    {{--Mobile</h4>--}}

                                                    {{--<div class="row col-xs-12">--}}
                                                    {{--<div class=" content__box content__box--shadow"--}}
                                                    {{--id="chatBox"--}}
                                                    {{--style="height:350px;overflow: auto;">--}}
                                                    {{--<div id="reload-admin">--}}
                                                    {{--</div>--}}

                                                    {{--</div>--}}
                                                    {{--</div>--}}


                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane  fade " id="my_referral">
                                    <section id="shopping-cart">
                                        <div class="container box-shadow mt-2 mb">
                                            <div class="heading text-center mb">
                                                <h3>All Products</h3>
                                            </div>

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table id="all_products" class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>View</th>
                                                            <th>Product Link</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($all_products as $key=> $product)
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>{{$product->name}}</td>
                                                                <td><a target="_blank"
                                                                       href="{{route('product.show',$product->slug)}}"
                                                                       class="btn btn-info"><i class="fa fa-eye"></i>
                                                                    </a></td>
                                                                <td>{{url('product/'.$product->slug)}} </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>View</th>
                                                            <th>Product Link</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                            </div>
                                        </div>

                                        <div class="content__box content__box--shadow">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <form class="form-group" action="{{route('user.referral')}}"
                                                          method="post">
                                                        {{csrf_field()}}
                                                        <label>Generate Referral Link</label>
                                                        <small>(Copy Product link and Paste)</small>
                                                        <input class="form-control" name="referral_link">
                                                        <button class="btn btn-success btn-sm">Generate Link</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content__box content__box--shadow">
                                            <div class="row">
                                                <div class="input-cart col-md-12 table-responsive">
                                                    <h2>Generated Links</h2>
                                                    <table id="example" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Refer Link</th>
                                                            <th>Product Link</th>
                                                            <th>Token</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($super_links as $key=>$value)
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>{{$value->refer_link}}</td>
                                                                <td>{{$value->product_link}}</td>
                                                                <td>{{$value->token}}</td>
                                                                <td><a href="" class="btn btn-danger"><i
                                                                                class="fa fa-trash"></i> </a></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Refer Link</th>
                                                            <th>Product Link</th>
                                                            <th>Token</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>    <!-- /#page-wrapper-->

                                    </section>
                                </div>
                                <div class="tab-pane  fade " id="my_wallet">
                                    <section id="shopping-cart">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Total Amount</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Your Wallet</td>
                                                        <td>{{round($wallet->total_amount,'2')}}</td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="content__box content__box--shadow">
                                            <div class="row">
                                                <div class="input-cart col-md-12 ">
                                                    <h2>Latest Referrals</h2>
                                                    <table id="example" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Sn</th>
                                                            <th>Ordered User Name</th>
                                                            <th>Referred Product</th>
                                                            <th>Referral Status</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($transaction as $key=> $value)
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>{{$value->orders->user->user_name}}</td>
                                                                <td>{{$value->orders->products->first()->name}}</td>
                                                                <td>
                                                                    @if($value->status==2)
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-success btn-sm"><i
                                                                                    class="fa fa-check"></i> </a>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-danger btn-sm"><i
                                                                                    class="fa fa-times"></i> </a>

                                                                    @endif
                                                                </td>
                                                                <td>{{$value->amount}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Sn</th>
                                                            <th>Order Name</th>
                                                            <th>Referred Product</th>
                                                            <th>Referral Status</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>  <!-- /#page-wrapper-->

                                    </section>
                                </div>


                            </main> <!-- END PRIMARY CONTENT -->
                        </div>
                    </div>


                </div><!-- END MAIN -->
            </div>
        </div>
    </section>
@endsection

@section('extra_scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#all_products').DataTable();
            $('#example-1').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#usersOrderTable').DataTable();
        });

        $(document).ready(function () {
            $('#usersPreOrderTable').DataTable();
        });

        $(document).ready(function () {
            $('#usersOrderReturnTable').DataTable();
        });

        $(document).ready(function () {
            $('#wishlistTable').DataTable();
        });

        $(document).ready(function () {
            $('#negotiableTable').DataTable();
        });

        $(document).ready(function () {
            $('#referralTable').DataTable();
        });

        $(document).ready(function () {
            $('#account button').on('click', function () {

                var $this = $(this);

                var id = $this.attr('data-id');
                var row = $(this).parent().parent().parent().children('.panel');
                var parent = $(this).parent().parent();
                var len = row.length;
                if (parent.children('.panel-heading ').children('i').hasClass('lx')) {
                    row.children('.panel-heading').children('.lx').remove();
                }
                else {
                    for (var i = 0; i < len; i++) {
                        row.children('.panel-heading').children('.lx').remove();
                    }
                    parent.children('.panel-heading').append('<i class="fas fa-star pull-left uk-margin-right lx fa-1x"  style="color:gold"></i>');
                }

                var tempUseUrl = "{{ route('my-account.shipping.use') }}";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: tempUseUrl,
                    data: {'id': id},
                    beforeSend: function (data) {
                    },
                    success: function (data) {
                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    },
                    complete: function () {
                    }
                });
            });
        });

        var $edit_shipping = $('#edit_address_shipping');

        $(document).on("click", ".btn-edit", function (e) {
            e.preventDefault();
            var $this = $(this);
            var id = $this.attr('data-edit-id');
            var tempEditUrl = "{{ route('my-account.shipping.edit', ':id') }}";
            tempEditUrl = tempEditUrl.replace(':id', id);

            $edit_shipping.load(tempEditUrl, function (response) {
                $edit_shipping.modal('show');
            });
        });

        $(document).on("click", ".modal-close", function (e) {
            e.preventDefault();
            $edit_shipping.hide();
        });

        $(document).on("click", ".buyprebooking", function (e) {
            e.preventDefault();
            var $this = $(this);
            var product = $this.attr('data-product');
            var order = $this.attr('data-order');
            var quantity = 1;
            // var select = document.getElementById("select_size");
            // if (document.querySelector('input[name="size"]:checked')) {
            //     var size = document.querySelector('input[name="size"]:checked').value;
            // }

            if (product) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.prebooking')  }}",
                    data: {
                        product: product,
                        order: order,
                        quantity: quantity
                        // size: size
                    },
                    beforeSend: function (data) {
                        $this.button('loading');
                    },
                    success: function (data) {
                        if (data.status) {
                            location.href = "{{ route('checkout') }}";
                        }

                        UpdateMiniCart();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var err;
                        if (xhr.status === 401) {
                            err = eval("(" + xhr.responseText + ")");
                            sweetAlert('error', 'Oops...', err.message);
                            return false;
                        }

                        sweetAlert('error', 'Oops...', 'Something went wrong!');
                    },
                    complete: function () {
                        $this.button('reset');
                        //$("html, body").animate({scrollTop: 0}, "slow");
                    }
                });
            }

        });

    </script>
@endsection