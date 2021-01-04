<div class="navbar-default sidebar" role="navigation" style="margin-top: 0;">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-title"><i class="fas fa-tachometer-alt fa-fw"></i> Dashboard</li>


            <li><a href="javascript:void(0)"><i class="fab fa-product-hunt fa-fw"></i> Products<span
                            class="fas fa-angle-down arrow"></span></a>
                <ul class="nav nav-second-level ">
                    <li><a href="{{ route('vendor.products.table', 'status='.'all') }}" class="allProducts"><i
                                    class="fa fa-eye"></i> All Products</a></li>
                    <li><a href="{{ route('vendor.products.create.new') }}" class="addProduct"><i class="fa fa-plus"></i>
                            Add Product</a></li>
                </ul>
                <!-- /.nav-second-level-->
            </li>
            <li><a href="{{ route('vendor.brands.index') }}"><i class="fa fa-bars fa-fw"></i> Brands</a>
            </li>
            <li><a href="javascript:void(0)"><i class="fab fa-first-order fa-fw"></i> Orders<span
                            class="fas fa-angle-down arrow"></span></a>
                <ul class="nav nav-second-level ">
                    <li><a href="{{ route('vendor.order.index') }}" class="allOrders"><i class="fa fa-eye"></i> All
                            Orders</a></li>
                    <li><a href="{{ route('vendor.order.return') }}" class="orderReturn"><i class="fa fa-eye"></i> Order
                            Returns</a></li>
                </ul>
                <!-- /.nav-second-level-->
            </li>
            <li><a href="javascript:void(0)"><i class="fab fa-adversal fa-fw"></i> Ads<span
                            class="fas fa-angle-down arrow"></span></a>
                <ul class="nav nav-second-level ">
                    <li><a href="{{ route('vendor.advertise.index') }}" class="allProducts"><i class="fa fa-eye"></i> My
                            Ads</a></li>
                    <li><a href="{{ route('vendor.advertise.create') }}" class="addProduct"><i class="fa fa-plus"></i>
                            Create Ads</a></li>
                </ul>
                <!-- /.nav-second-level-->
            </li>
            <li><a href="javascript:void(0)"><i class="fas fa-money-bill-alt fa-fw"></i> Withdraws<span
                            class="fa fa-angle-down arrow"></span></a>
                <ul class="nav nav-second-level ">
                    <li><a href="{{ route('vendor.withdraw') }}" class="allProducts"><i class="fa fa-eye"></i> My
                            Withdraws</a></li>
                    <li><a href="{{ route('vendor.withdraw.account') }}" class="addProduct"><i class="fa fa-plus"></i>
                            New withdraw</a></li>

                </ul>
                <!-- /.nav-second-level-->
            </li>
            <li><a href="{{route('vendor.vendor.reviews.index')}}"><i class="fas fa-star"></i> My Ratings</a>
            </li>
            <li><a href="{{route('vendor.negotiate')}}"><i class="fas fa-handshake"></i> Negotiables</a>
            </li>
            <li><a href="{{route('vendor.disputes')}}"><i class="fas fa-thumbs-down"></i> Disputes</a>
            </li>
            <li><a href="{{route('vendor.reviews.index')}}"><i class="fab fa-replyd"></i> Reviews</a>
            </li>
            <li><a href="{{route('vendor.chat')}}"><i class="fas fa-comments"></i> Talk with Owner</a>
            </li>
            <li><a href="{{route('vendor.config')}}"><i class="fas fa-cogs"></i> Settings</a></li>

            @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Super-Vendor' || \Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Regional-Manager')

                <li><a href="javascript:void(0)"><i class="fa fa-user"></i>Vendors & Wallet<span
                                class="fas fa-angle-down arrow"></span></a>
                    <ul class="nav nav-second-level ">
                        <li><a href="{{route('vendor.wallet')}}"><i class="fas fa-shopping-bag"></i>Referral Wallet</a></li>

                        <li><a href="{{route('vendor.add-vendor')}}"><i class="fas fa-handshake"></i>Add Vendor</a></li>
                        <li><a href="{{route('vendor.all-referral')}}"><i class="fas fa-list"></i>All Vendor Referrals</a>
                        </li>


                        <li><a href="{{ route('vendor.referral_link') }}" class="addProduct"><i
                                        class="fa fa-plus"></i>
                                Super Store Referral Link</a></li>
                    </ul>
                    <!-- /.nav-second-level-->
                </li>
            @endif


        </ul>
    </div>
    <!-- /.sidebar-collapse-->
</div>
<!-- /.navbar-static-side-->
