<header class="header">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <a href="{{route('sell.become')}}">
        <div class="top-header">
            <div class=" d-flex align-items-center justify-content-between ">
                <img src="https://i.postimg.cc/nzNz08Qw/Become-a-seller.png" alt="Become-a-seller" width="100%">
            </div>
        </div>
    </a>
    <div class="main-header nav-overlay " style="
            background-image: url({{asset('images/background/header-bg.png')}}); z-index: 1000;"
         uk-sticky="top: 450;  animation: uk-animation-slide-top">
        <div class="container relative">
            <!-- TOP HEAD SECTION    -->
            <div class="row">
                <div class="col-md-3 col-sm-12 ">
                    <div class="logo__and__user relative ">

                        <div class="logo">
                            <a href="#offcanvas-usage" uk-toggle class="bars float-left" style="display: none;">
                                <i class="fas fa-bars"></i>
                            </a>
                            <a href="{{ route('home.index') }}" class="logo-link" href="javascript:void(0)">
                                <span class="company_name text-right">
                                         <img src="{{asset('storage/'.getConfiguration('site_logo'))}}">

                                </span>

                            </a>


                            <figure><img src="images/websitelogo.png" alt=""></figure>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="mobile_screen" style="display: none">
                            <div class="users">
                                <div class="user-login">
                                    <ul class="user_login_ul">
                                        @if(Auth::check())
                                            <li class="user_login_li active relative">

                                                <a href="#" class="user-login-link d-block text-center ">


                                                    <p><i class="user mr-2"
                                                          uk-icon="icon:user;"></i><span>{{ Auth::user()->user_name }}</span>
                                                    </p>
                                                </a>
                                                <ul class="user_login_ul sub_ul">
                                                    <li class="sub_li"><a href="{{ route('user.account') }}">Account</a>

                                                    <li class="sub_li"><a href="{{ route('wishlist.mywishlist') }}">Wishlist</a>
                                                    </li>
                                                    @if(\Illuminate\Support\Facades\Auth::check() && Auth::user()->roles->isnotEmpty() && Auth::user()->roles->first() != null )
                                                        @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name =='vendor' || \Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Super-Vendor')
                                                            <li class="sub_li"><a
                                                                        href="{{ route('vendor.dashboard') }}">Seller
                                                                    Dashboard</a>
                                                        @endif
                                                    @endif
                                                    <li class="sub_li"><a href="{{ route('user.account') }}">Order</a>
                                                    </li>
                                                    <li class="sub_li">
                                                        <form id="logout_form-md" action="{{ route('logout') }}"
                                                              method="post">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <a href="#"
                                                           onclick="event.preventDefault(); document.getElementById('logout_form-md').submit();">Logout</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="user_login_li relative">
                                                <!--<a href="#" class="user-login-link " data-toggle="modal"-->
                                                <!--   data-target="#login__form">-->
                                                <a href="{{route('login')}}" class="user-login-link ">
                                                    <span>Login & SignUp</span>
                                                    <i class="user " uk-icon="icon:user;" style="display: none"></i>
                                                    <!--<i class="far fa-user user" style="display: none"></i>-->
                                                </a>
                                            </li>
                                        @endif
                                    </ul>


                                </div>
                                {{--<div class="more_dd">--}}
                                {{--<a href=""> <span>More</span></a>--}}
                                {{--<ul class="more__dd_ul sub_ul">--}}
                                {{--<li class="sub_li"><a href="{{ route('request.product.create') }}"--}}
                                {{--class="checkout btn-danger text-white float-none">Request--}}
                                {{--Product</a></li>--}}
                                {{--<li class="sub_li"><a href="{{ route('sell.index') }}">Sell On SmartBazaar </a>--}}
                                {{--</li>--}}
                                {{--<li class="sub_li"><a href="{{ route('track.order') }}">Track Your Order</a>--}}
                                {{--</li>--}}
                                {{--<li class="sub_li"><a href="#">Download App</a></li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                <div class="user-cart" id="update-cart">
                                    <a href="{{ route('cart') }}" class="user-cart-link">
                                        <!--<span>Cart</span>-->
                                        <i class="d-block " style="width:30px; height:30px;">
                                            <svg height="30" width="30" aria-hidden="true" focusable="false"
                                                 data-prefix="fab" data-icon="opencart"
                                                 class="svg-inline--fa fa-opencart fa-w-20" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path fill="currentColor"
                                                      d="M423.3 440.7c0 25.3-20.3 45.6-45.6 45.6s-45.8-20.3-45.8-45.6 20.6-45.8 45.8-45.8c25.4 0 45.6 20.5 45.6 45.8zm-253.9-45.8c-25.3 0-45.6 20.6-45.6 45.8s20.3 45.6 45.6 45.6 45.8-20.3 45.8-45.6-20.5-45.8-45.8-45.8zm291.7-270C158.9 124.9 81.9 112.1 0 25.7c34.4 51.7 53.3 148.9 373.1 144.2 333.3-5 130 86.1 70.8 188.9 186.7-166.7 319.4-233.9 17.2-233.9z"></path>
                                            </svg>
                                        </i>
                                    <!--<img src="{{ asset('image/cart.png') }}" alt="Cart">-->
                                    </a>
                                    <div class="user_cart_dd">
                                        @if(Cart::instance('default')->count())
                                            <ul class="user_cart_ul">
                                                @foreach(Cart::content() as $cartContent)
                                                    <li>
                                                        <figure style="float: left; margin-right: 10px; width: 50px;">
                                                            <img
                                                                    src="{{ asset(getProductImage($cartContent->id, 'small')) }}"
                                                                    alt="{{ $cartContent->name }}"></figure>
                                                        <p class="text-left">
                                                            <span> {{ $cartContent->name }}</span><br>
                                                            <span>{{ $cartContent->qty }}</span> <span>*</span>
                                                            <span>{{ $cartContent->price }}</span>

                                                        </p>
                                                        <div class="clearfix"></div>
                                                        <hr>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="cart_subtotal">
                                                <div class="float-left">Subtotal</div>
                                                <div class="float-right"><span class=""><span
                                                                class="">Rs.</span>{{ Cart::instance('default')->total() }}</span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr>
                                            </div>
                                            <a href="{{ route('cart') }}" class="btn  btn-default view-cart float-left">View
                                                Cart</a>
                                            <a href="{{ route('checkout') }}"
                                               class="btn btn-danger checkout float-right">Checkout</a>
                                            <div class="clearfix"></div>
                                        @else
                                            <div class="cart-empty">
                                                <p class="mb-none">No products in cart.</p>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="search_toggler px-3">
                                    <a href="javascript:void(0)" uk-icon="search"></a>
                                </div>
 

                            </div>
                        </div>
                        <div class="hidden-search"
                             style="position: absolute;z-index: 9999;top: -3px;width: 100%;background: white; display: none;">
                            <form class="uk-search uk-search-navbar uk-width-1-1">
                                <input class="uk-input" type="search" type="search" name="query" id="searchTextSm" placeholder="Search..." autofocus>
                            </form>
                            <a class="close_search" href="#" uk-close=""
                               style="float: right;color:#666; margin-top: -28px;padding: 0 15px;"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="search-box ">
                        <div class="uk-margin">
                            <form action="{{route('search')}}" method="get" class="uk-search uk-search-default ">
                                {{-- <span class="uk-search-icon-flip" uk-search-icon></span> --}}
                                <input class="uk-search-input" type="search" name="query" id="searchTextLg"
                                       placeholder="Search...">
                                <button class="btn btn-primary" type="submit">Go</button>
                                {{-- <input type="submit" class="btn btn-primary" > --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="users big-screen">
                        <div class="user-login">

                            <ul class="user_login_ul">
                                @if(Auth::check())
                                    <li class="user_login_li active relative">
                                        <a href="#" class="user-login-link d-block text-center ">
                                            <i class="user" uk-icon="icon:user; ratio: 1.5"></i>

                                            <p><span>{{ Auth::user()->user_name }}</span></p>
                                        </a>
                                        <ul class="user_login_ul sub_ul">
                                            <li class="sub_li"><a href="{{ route('user.account') }}">Account</a></li>
                                            @if(\Illuminate\Support\Facades\Auth::check() && Auth::user()->roles->isnotEmpty() && Auth::user()->roles->first() != null )
                                                @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name =='vendor' || \Illuminate\Support\Facades\Auth::user()->roles->first()->name=='Super-Vendor')
                                                    <li class="sub_li"><a
                                                                href="{{ route('vendor.dashboard') }}">Seller
                                                            Dashboard</a>
                                                @endif
                                            @endif
                                            <li class="sub_li"><a href="{{ route('wishlist.mywishlist') }}">Wishlist</a>
                                            </li>
                                            <li class="sub_li"><a href="{{ route('user.account') }}">Order</a></li>
                                            <li class="sub_li">
                                                <form id="logout_form-md" action="{{ route('logout') }}" method="post">
                                                    {{ csrf_field() }}
                                                </form>
                                                <a href="#"
                                                   onclick="event.preventDefault(); document.getElementById('logout_form-md').submit();">Logout</a>


                                        </ul>
                                    </li>
                                @else
                                    <li class="user_login_li relative">
                                        <a href="{{route('login')}}" class="user-login-link d-block"
                                        >
                                            <i class="user" uk-icon="icon:user; ratio: 1.5"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>

                        </div>

                        <div class="user-cart" id="update-minicart">
                            <a href="javascript:void(0)" class="user-cart-link d-block  ">
                                <i class="d-block " style="width:30px; height:30px;">
                                    <svg height="30" width="30" aria-hidden="true" focusable="false"
                                         data-prefix="fab" data-icon="opencart"
                                         class="svg-inline--fa fa-opencart fa-w-20" role="img"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="currentColor"
                                              d="M423.3 440.7c0 25.3-20.3 45.6-45.6 45.6s-45.8-20.3-45.8-45.6 20.6-45.8 45.8-45.8c25.4 0 45.6 20.5 45.6 45.8zm-253.9-45.8c-25.3 0-45.6 20.6-45.6 45.8s20.3 45.6 45.6 45.6 45.8-20.3 45.8-45.6-20.5-45.8-45.8-45.8zm291.7-270C158.9 124.9 81.9 112.1 0 25.7c34.4 51.7 53.3 148.9 373.1 144.2 333.3-5 130 86.1 70.8 188.9 186.7-166.7 319.4-233.9 17.2-233.9z"></path>
                                    </svg>
                                </i>
                            </a>
                            <div class="cart-count">
                                <span>{{count(\Gloudemans\Shoppingcart\Facades\Cart::content())}}</span>
                            </div>
                            <div class="user_cart_dd">
                                @if(Cart::instance('default')->count())
                                    <ul class="user_cart_ul">
                                        @foreach(Cart::content() as $cartContent)
                                            <li>
                                                <figure style="float: left; margin-right: 10px; width: 50px;"><img
                                                            src="{{ asset(getProductImage($cartContent->id, 'small')) }}"
                                                            alt="{{ $cartContent->name }}"></figure>
                                                <p class="text-left">
                                                    <span> {{ $cartContent->name }}</span><br>
                                                    <span>{{ $cartContent->qty }}</span> <span>*</span>
                                                    <span>{{ $cartContent->price }}</span>

                                                </p>
                                                <div class="clearfix"></div>
                                                <hr>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cart_subtotal">
                                        <div class="float-left">Subtotal</div>
                                        <div class="float-right"><span class=""><span
                                                        class="">Rs.</span>{{ Cart::instance('default')->total() }}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <a href="{{ route('cart') }}" class="btn  btn-default view-cart float-left">View
                                        Cart</a>
                                    <a href="{{ route('checkout') }}" class="btn btn-danger checkout float-right">Checkout</a>
                                    <div class="clearfix"></div>
                                @else
                                    <div class="cart-empty">
                                        <p class="mb-none">No products in cart.</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <ul class="user-wishlist relative">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <li><a href="{{ route('wishlist.mywishlist') }}" class="user-wishlist-link px-3 d-block " title="View Wishlist">
                                        <span class="font-weight-bold" style="font-size: 24px"> 
                                         <i class="heart d-block" style="width:30px; height:30px;"
                                            uk-icon="icon:heart; ratio: 1.5"></i>
                                        </span>
                                    </a>
                                </li>
                                {{-- <div class="cart-count">
                                    <span></span>
                                </div> --}}
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
            <div class="bottom__nav pt-md-3 pt-sm-2 pt-1" id="bottom__nav">
                <div class="row">
                    <div class="col-xl-3 col-sm-12 hide-on-mobile d-xl-block d-none px-0">

                        <span id="toggle_dd" class="border toggle_dd p-1"><i class="mr-2" uk-icon="menu"></i> All Products </span>
                        <div uk-dropdown="pos: bottom-justify" style="padding:0!important">
                            <div class="main_dropdown" style="height: auto">
                                <ul class="menu-items">

                                @foreach($productCategories->take(16) as $menu)                    <!-- submenus -->
                                    <li class="menu-items--item">
                                        <a title="{{$menu->name}}"
                                           href="{{ url('/') . '/category/' . $menu->slug }}">{{$menu->name}}</a>
                                        <!-- first submenus -->
                                        @if($menu->subCategory->isNotEmpty())

                                            <ul class="menu-items sub-menus-1" style="height: auto">
                                                @foreach($menu->subCategory->take(16) as $child)
                                                    <li class="menu-items--item sub-menus-1-list">
                                                        <a title="{{$child->name}}"
                                                           href="{{ url('/') . '/category/' . $child->slug }}">{{ $child->name }}</a>
                                                        <!-- second submenus -->
                                                        @if($child->subCategory->isNotEmpty())
                                                            <ul class="menu-items sub-menus-2" style="height: auto">


                                                                @foreach($child->subCategory->take(16) as $subchild)
                                                                    <li class="menu-items--item sub-menus-1-list"><a
                                                                                title="{{$subchild->name}}"
                                                                                href="{{ url('/') . '/category/' . $subchild->slug }}">{{ $subchild->name }}</a>
                                                                @endforeach

                                                            </ul>
                                                        @endif

                                                    </li>
                                                @endforeach

                                            </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{--<span id="toggle_dd-1" class="border toggle_dd p-1 ml-1"><i class="mr-2" uk-icon="menu"></i> Services </span>
                        <div uk-dropdown="pos: bottom-justify" style="padding:0!important">
                            <div class="service_dropdown">
                                <ul class="menu-items">
                                    <!-- submenus -->
                                    @foreach( $serviceCategories as $serviceCategory )

                                        <li class="menu-items--item"><a
                                                    href="{{ route('service.link', ['slug' => $serviceCategory->slug]) }}">{{ $serviceCategory->name }} </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>--}}
                    </div>
                    <div class="col-xl-6 col-sm-8 d-flex justify-content-start align-items-center bottom__nav-mid">
                        <div class="mr-3 d-block"><a href="{{route('home.index')}}"><span class="mr-2"
                                                                                          uk-icon="tag"></span>Shop
                                Products </a></div>
                        {{--<div class="mr-3 d-block"><a href="{{ route('services.index') }}"><span class="mr-2"
                                                                                                uk-icon="bolt"></span>Shop
                                Service</a></div>--}}
                        <div class="mr-3 d-block"><a href="{{ route('sell.become') }}"><span class="mr-2"
                                ><img src="https://i.postimg.cc/Wp9Sp5cY/star.png" width="20px"></span>Become
                                A Seller</a></div>
                        <div class="mr-3 d-block"><a href=""><span class="mr-2" uk-icon="phone"></span>Get App</a></div>
                    <!--<div class="mr-3 d-block"><a href="{{route('track.order')}}"><span class="mr-2"-->
                        <!--                                                                   uk-icon="phone"></span>Track-->
                        <!--        Order</a></div>-->

                    </div>
                    <div class="col-xl-3 col-sm-4  d-sm-block d-none text-right">
                        <span class="text-white ">Customer Support: {{getConfiguration('site_primary_phone')}}</span>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>

</header>


<!-- The whole page content goes here -->


<div id="offcanvas-usage" uk-offcanvas>
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <section class="mobile-nav">

            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('home') }}" aria-expanded="true">Home</a>
                </li>
                <li>
                    <a href="{{ route('services.index') }}" aria-expanded="false"><span class="fa arrow"></span>Services</a>

                    <ul aria-expanded="false" class="list-levels">
                        @foreach( $serviceCategories->take(6) as $serviceCategory )

                            <li>
                                <a href="{{ route('service.link', ['slug' => $serviceCategory->slug]) }}">{{ $serviceCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{route('track.order')}}">Track Oder</a>
                </li>
                {{-- @foreach($productCategories->slice(0, 10) as $menu)

                    <li>
                        <a href="{{ url('/') . '/category/' . $menu->slug }}"
                           aria-expanded="false">{{ $menu->name }}@if($menu->subCategory->isNotEmpty()) <span
                                    class="fa arrow"></span> @endif</a>
                        @if($menu->subCategory->isNotEmpty())

                            <ul aria-expanded="false" class="list-levels">
                                @foreach($menu->subCategory as $child)

                                    <li>
                                        <a href="{{ url('/') . '/category/' . $child->slug }}">{{ $child->name }} @if($child->subCategory->isNotEmpty())
                                                <span
                                                        class="fa arrow"></span> @endif</a>
                                @endforeach
                            </ul>
                        @endif

                    </li>
                @endforeach --}}
            </ul>

        </section>
    </div>
</div>
