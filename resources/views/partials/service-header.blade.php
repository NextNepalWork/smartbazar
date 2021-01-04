<!--top bar-->
<div class="top-bar desktop-only">
    <div class="container">
        <ul class="nav liststyle--none">
            <li class="menu-item animate-dropdown"><a title="" href="{{ route('home.index') }}">DEPARTMENTS </a></li>
            <li class="menu-item animate-dropdown"><a title="" href="{{ route('sell.service') }}">SELL SERVICE ON AAXIM </a></li>
            <!--@if(Auth::check())-->
            <!--<li class="menu-item animate-dropdown"><a href="{{ route('user.account') }}"><i class="far fa-user"></i>&nbsp;{{ Auth::user()->user_name }}</a></li>-->
            <!--@else-->
            <!--<li class="menu-item animate-dropdown"><a href="{{ route('user.account') }}"><i class="far fa-user"></i>&nbsp;Register or Sign in</a></li>-->
            <!--@endif        -->
        </ul>
    </div>
</div>


<header class="site-header service-header " uk-sticky>
    <div class="desktop-only container ">
        <!--sticky bar-->
        <div class="sticky-wrapper ">
            <div class="row flex-row">
                <div class="site-branding">
                     <a href="{{url('/')}}" style="font-size: 2em">
                                    <img src="{{ url('storage') . '/' . getConfiguration('site_logo') }}">

                                </a>
                </div>
                <div class="orders-wrapper">
                    <ul class="liststyle--none">
                        <li><a href="{{ route('sell.service') }}"><i class="fas fa-user-tie"></i>Become a professional</a></li>
                         @if(Auth::check())
                    <li><a href="{{ route('user.account') }}"><i class="far fa-user"></i>{{ Auth::user()->user_name }}</a></li>
                	@else
                    <li><a href="{{ route('user.account') }}"><i class="far fa-user"></i>Register or Sign in</a></li>
                	@endif
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <div class="desktop-only main-bar">
        <!--sticky bar-->

        <div class="container uk-padding-small">

            <!--main bar-->
            <div class="flex-row">
                <div class="cd-dropdown-wrapper">
    <a class="cd-dropdown-trigger desktop-only" href="#0"><i class="fas fa-bars"></i>Services</a>
    <a class="cd-dropdown-trigger mobile-trigger mobile-only" href="#0"><span uk-icon="icon: menu"></span></a>
    <nav class="cd-dropdown">
        <h2>Title</h2>
        <a href="#" class="cd-close">Close</a>
        <ul class="cd-dropdown-content liststyle--none">
            <li class="hidden-md hidden-lg">
                <form class="cd-search">
                    <input type="search" placeholder="Search...">
                </form>
            </li>
            @foreach( $serviceCategories as $serviceCategory )
                            <li class="has-children">
                                <a href="{{ route('service.link', ['slug' => $serviceCategory->slug]) }}">{{ $serviceCategory->name }}</a>
                                @if($serviceCategory->services->isNotEmpty())
                                <ul class="cd-secondary-dropdown is-hidden liststyle--none">
                                    @foreach($serviceCategory->services as $service)
                                    <li class="go-back"><a href="{{ route('service.show', ['slug' => $service->slug]) }}">{{ $service->name }}</a></li>
                                        @endforeach
                                </ul> <!-- .cd-secondary-dropdown -->
                                    @endif
                            </li> <!-- .has-children -->
                            @endforeach

        </ul> <!-- .cd-dropdown-content -->
    </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->

                <form class="navbar-search" method="">
                    <label class="sr-only screen-reader-text" for="search">Search for:</label>
                    <div class="input-group">
                        <input type="text" class="form-control search-field product-search-field" value=""
                               placeholder="What service are you looking for?">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                                <span class="search-btn"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="mobile-only container-fluid">
        <div class="mobile-header">
            <div class="flex-row">
                <div class="site-branding">
                     <a href="{{url('/')}}" style="font-size: 2em">
                                    <img src="{{ url('storage') . '/' . getConfiguration('site_logo') }}">

                                </a>
                </div>
            </div>
            <div class="sticky-wrapper">
                <div class="sticky-wrap">
                    <div class="flex-row">
                        <div class="cd-dropdown-wrapper">
    <a class="cd-dropdown-trigger desktop-only" href="#0"><i class="fas fa-bars"></i>Services</a>
    <a class="cd-dropdown-trigger mobile-trigger mobile-only" href="#0"><span uk-icon="icon: menu"></span></a>
    <nav class="cd-dropdown">
        <h2>Title</h2>
        <a href="#" class="cd-close">Close</a>
        <ul class="cd-dropdown-content liststyle--none">
            <li class="hidden-md hidden-lg">
                <form class="cd-search">
                    <input type="search" placeholder="Search...">
                </form>
            </li>
            @foreach( $serviceCategories as $serviceCategory )
                            <li class="has-children">
                                <a href="{{ route('service.link', ['slug' => $serviceCategory->slug]) }}">{{ $serviceCategory->name }}</a>
                                @if($serviceCategory->services->isNotEmpty())
                                <ul class="cd-secondary-dropdown is-hidden liststyle--none">
                                    @foreach($serviceCategory->services as $service)
                                    <li class="go-back"><a href="{{ route('service.show', ['slug' => $service->slug]) }}">{{ $service->name }}</a></li>
                                        @endforeach
                                </ul> <!-- .cd-secondary-dropdown -->
                                    @endif
                            </li> <!-- .has-children -->
                            @endforeach
        </ul> <!-- .cd-dropdown-content -->
    </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->
                        <div class="site-search">
							
                            <div class="product_search">
                                <form role="search" class="product-search-form" >
                                    <label class="sr-only screen-reader-text" for="product-search-field">Search for:</label>
                                    <input type="search" id="product-search-field" class="search-field" placeholder="Search products…" value="" name="s">
                                    <input type="submit" value="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>









