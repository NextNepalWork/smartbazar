@extends('layouts.app')

@section('extra_styles')
    <style>
        .clock {
            color: black;
            font-size: 18px;
            font-weight: 700;
            padding: 5px;
            position: absolute;
            background: #ffc400;
        }

        .countdown {
            margin-left: 9px !important;
        }
        /* .product-category.white-product .product .product_wrap_overlay {
            !* top: 0; *!
            right: 0;
            bottom: 0;
            left: 0;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 10;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all .3s ease;
            height: 20%;
        }

        .product-category.white-product .product:hover .product_wrap_overlay {
            opacity: 1;
        }

        .product-category.white-product .product:hover .product_wrap_overlay span {
            height: 100%;
            background: #0000cc;
        }

        .product-category.white-product .product:hover .product_wrap_overlay span .far {
            color: #fff;
        } */
    </style>

@endsection
@section('content')

    <div id="slide-banner">
        <div id="sliding_banner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($slideshows as $slideshow)
                    <li data-target="#sliding_banner" data-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach

            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($slideshows as $slideshow)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @if(!empty($slideshow->link))
                            <a href="{{ $slideshow->link }}"> <img src="{{ url('/').$slideshow->image }}" alt=""></a>
                        @else
                            <a href="#">
                                <img src="{{ url('/').$slideshow->image }}">
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#sliding_banner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#sliding_banner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="bg-fixed"
         style="background-image: url({{asset('images/background/bg.png')}}); background-attachment: fixed; background-position: center;background-repeat: no-repeat;background-size:cover">
        <section class="product-grid dealofday mb">
            <div class="container-fluid">
                <div class="d-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 product--grid">
                        @foreach($deals as $key => $value)
                            <div class="product-grid-content">
                                <div class="countdown float-left">
                                    <h3 class="text-white">{{$value->name}}</h3>
                                    <div id="the-final-countdown">
                                        <ul class="liststyle--none d-flex align-items-center">
                                            {{-- <p id="demo"></p> --}}
                                            <div class="countdown">
                                           
                                            <span class="clock">
                                                
                                            </span>
                                            </div>
                                            {{-- <li><span id="hours"></span></li>
                                            :
                                            <li><span id="minutes"></span></li>
                                            :
                                            <li><span id="seconds"></span></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                {{-- <a href="{{ route('category', ['slug' => $value->name]) }}" class="float-right view-more">view more<span class="ml-2" uk-icon="forward"></span></a> --}}
                                <a href="javascript:;" class="float-right view-more">view more<span class="ml-2" uk-icon="forward"></span></a>
                                <div class="clearfix"></div>
                            </div>

                            <div class="product-category white-product box-shadow-2">
                                <div class="containers">
                                    <div class="owl-carousel dealofday-carousel inner-column">
                                        @foreach($value->products as $product)

                                            <article class="product instock sale purchasable">
                                                <div class="product-wrap">
                                                    @if($product->negotiable == 1)
                                                        <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                                    @endif

                                                    @php
                                                        $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                                    @endphp
                                                    @if($discount != 0)
                                                        <div class="dis-tag">
                                                            <figure><img src="{{asset('images/tags/tag.png')}}" alt="">
                                                            </figure>

                                                            <span class="dis-tag-price">{{$discount}}
                                                                %</span>

                                                        </div>
                                                    @endif
                                                    <div class="product-top">
                                                        <figure>
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                                <div class="product-image">
                                                                    <img width="320" height="320"
                                                                         src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                         class="attachment-shop_catalog size-shop_catalog"
                                                                         alt="{{ $product->name }}">
                                                                </div>
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="product-description">
                                                        <div class="product-meta">
                                                            <div class="title-wrap">
                                                                <p class="product-title">
                                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                                       class="line-clamp1">{{ $product->name }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="product-meta-container">
                                                            <div class="product-price-container">
                                                            <span class="price">
                                                                @if($product->product_price == $product->sale_price)
                                                                    <span class="Price-amount amount">
                                                                        <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                    </span>
                                                                @else
                                                                    <span class="Price-amount discount">
                                                                        <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                    </span>
                                                                    <span class="Price-amount amount">
                                                                        <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                    </span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product_wrap_overlay">
                                                        <a href="javascript:;" class="btn-quickview" data-id="{{ $product->id }}"><span><i class="far fa-eye"></i></span></a>
                                                    </div> --}}
                                                </div>
                                            </article>

                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </section>

        <section class="three-columns mb">
            <div class="container-fluid">
                <div class="row  m-0">
                    <div class="col-6 col-sm-3 mb-2">
                        <a href="{{ getConfiguration('category_ads_link_1') }}"><img class="img img-fluid"
                                    src="{{ url('storage') . '/' . getConfiguration('category_ads_image_1') }}"
                                    alt="{{ getConfiguration('category_ads_2') }}"></a>
                    </div>
                    <div class="col-6 col-sm-3 mb-2">
                        <a href="{{ getConfiguration('category_ads_link_2') }}"><img class="img img-fluid"
                                    src="{{ url('storage') . '/' . getConfiguration('category_ads_image_2') }}"
                                    alt="{{ getConfiguration('category_ads_2') }}"></a>
                    </div>
                    <div class="col-6 col-sm-3 mb-2">
                        <a href="{{ getConfiguration('category_ads_link_3') }}"><img class="img img-fluid"
                                    src="{{ url('storage') . '/' . getConfiguration('category_ads_image_3') }}"
                                    alt="{{ getConfiguration('category_ads_3') }}"></a>
                    </div>
                    <div class="col-6 col-sm-3 mb-2">
                        <a href="{{ getConfiguration('category_ads_link_4') }}"><img class="img img-fluid"
                                    src="{{ url('storage') . '/' . getConfiguration('category_ads_image_4') }}"
                                    alt="{{ getConfiguration('category_ads_4') }}"></a>
                    </div>

                </div>
            </div>
        </section>

        @php
            $category = \App\Model\Category::where('name', getHome('products_section_1'))->first();
        @endphp

        @if(getProductsByCategory(getHome('products_section_2'))->isNotEmpty())

            <section class="section-collection">
                <div class="container-fluid">
                    <div class="d-flex section-collection-tittle topic-title justify-content-between">
                        <div class="heading">
                            <h3 class="text-white">{{ getHome('products_section_2') }}</h3>
                        </div>
                        @if($category)
                            <a href="{{ route('category', ['slug' => $category->slug]) }}" class="view-more"> view
                                more</a>
                        @endif

                    </div>
                    <div class="row    ">
                        @foreach(getProductsByCategory(getHome('products_section_2'))->take(12) as $product)

                            <div class=" col-lg-3 col-md-4 col-sm-4 col-6">
                                <div class="collections-item">
                                    <a class="collections-link"
                                       href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                        <div class="collections-product">
                                            <figure>
                                                <img src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                     alt="">
                                            </figure>
                                        </div>
                                        <div class="collections-title">{{ $product->name }} &gt;</div>
                                        <div class="collections-subtitle"
                                        >
                                            {{$product->stock_quantity}} Items
                                        </div>


                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <section class="section-welcome_mall">
            <div class="container-fluid">
                <div class=" row  section-welcome_mall-title topic-title d-flex justify-content-between">
                    <div class="heading">
                        <h3 class="text-white">Our Vendors</h3>
                    </div>
                    <a href="{{route('our-vendors')}}" class="view-more"> view more</a>
                </div>
                <div class="row mall-carousel owl-carousel justify-content-between ">
                    @foreach($mall as $value)
                        <div class="welcome_mall-item relative">
                            {{-- <a href="{{route('vendor-profile',$value->name)}}" class="welcome_mall-detail"> --}}
                                <div class="welcome_mall-detail--logo">
                                    <figure>
                                        <img class="img img-fluid" src=" @if($value->company_images->first()){{asset('vendor_company_image/'.$value->company_images->first()->image)}} @endif "
                                             alt="">
                                    </figure>
                                </div>

                                <div class="welcome_mall-detail--name">
                                    <h4>{{$value->name}}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach


                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                </div>

            </div>

        </section>
        <div class="section_front-cat">
            <div class="container-fluid">
                <div class=" row front-cat_title topic-title d-flex justify-content-between">
                    <div class="heading">
                        <h3 class="text-white">categories</h3>
                    </div>
                    <a href="{{route('category-collection')}}" class="view-more"> view more</a>
                </div>
                <div class=" row  justify-content-between d-flex front-cat_details">
                    {{-- category header --}}
                    @foreach($productCategories as $value)
                        <div class="cat-detail">
                            <div class="cat-img" style="line-height: 50px">
                                <img src="{{asset('images/category/'.$value->category_image)}}" alt="">
                            </div>
                            <div class="cat-name">
                                <a href="{{ url('/') . '/category/' . $value->slug }}"><h3>{{$value->name}}</h3></a>
                            </div>
                        </div>
                    @endforeach
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                    <div class="dummy"></div>
                </div>
            </div>

        </div>
        @if(getProductsByCategory(getHome('products_section_3'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_3') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_3'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_3')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)
                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(getProductsByCategory(getHome('products_section_4'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_4') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_4'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_4')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)
                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>

                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(getProductsByCategory(getHome('products_section_5'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_5') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_5'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_5')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)
                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(getProductsByCategory(getHome('products_section_6'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_6') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_6'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_6')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)
                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">
                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(getProductsByCategory(getHome('products_section_7'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_7') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_7'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_7')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)

                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(getProductsByCategory(getHome('products_section_8'))->isNotEmpty())
            <section class=" category mb">
                <div class="container-fluid">
                    <div class="borders bg-white">
                        <div class="category-title border_bottom">
                            <div class="category--title float-left">
                                <h5>{{ getHome('products_section_8') }}</h5>
                            </div>
                            @php
                                $category = \App\Model\Category::where('name', getHome('products_section_8'))->first();
                            @endphp
                            @if($category)
                                <a href="{{ route('category', ['slug' => $category->slug]) }}"
                                   class="float-right view-more">view more<span class="ml-2"
                                                                                uk-icon="forward"></span></a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="product-category white-product">

                            <div class="owl-carousel categories">
                                @foreach(getProductsByCategory(getHome('products_section_8')) as $product)

                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            @if($product->negotiable == 1)

                                                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
                                            @endif
                                            @php
                                                $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

                                            @endphp
                                            @if($discount != 0)
                                                <div class="dis-tag">
                                                    <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>

                                                    <span class="dis-tag-price">{{$discount}}
                                                        %</span>

                                                </div>
                                            @endif
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="{{ $product->name }}">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                               class="line-clamp1">{{ $product->name }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                                        <span class="price">
                                                            @if($product->product_price == $product->sale_price)
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                            @else
                                                                <span class="Price-amount discount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                                                </span>
                                                                <span class="Price-amount amount">
                                                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section id="category-filter" class="category-filter">
            <div class="container-fluid">
                <div class="borders bg-white">
                    <div class="category-title border_bottom">
                        <div class="category--title float-left">
                            <h5>Just For you</h5>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="product-category white-product" id="add-product">


                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>

                    </div>
                    <div class="d-flex justify-content-center align-items-center add-load">
                        <div class="load">

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <div id="quickview-modal" class="product-description uk-modal"></div>


@endsection

@section('extra_scripts')
    <script src="{{asset('front/js/jquery.countdown.js')}}"></script>
    <script>
        $('.clock').countdown('2020/12/19 16:34:56')
            .on('update.countdown', function (event) {
                var format = '%H:%M:%S';
                if (event.offset.totalDays > 0) {
                    format = '%-d day%!d ' + format;
                    12
                }
                if (event.offset.weeks > 0) {
                    format = '%-w week%!w ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('This offer has expired!')
                    .parent().addClass('disabled');

            });
    </script>
    <script>
        $(document).ready(function () {
            $(window).on('load', function () {
                {{\Illuminate\Support\Facades\Session::forget('times')}}
            });

            var counter = 0;
            var max_counter = 8;


            $(window).on("scroll", function () {
                var totalheight = $(document).height();
                var windowheight = $(window).height();
                var scrollheight = Math.ceil($(window).scrollTop(), 0);
                var calculate = totalheight - windowheight;

                // console.log(scrollheight);
                // console.log(calculate);
                var x = window.matchMedia("(max-width: 767px)");
                // var y = window.matchMedia("(max-width: 991px)");
                if (x.matches) {
                    if (scrollheight >= calculate - 100 && counter < max_counter) {
                        console.log(scrollheight);

                        counter++;


                        $.ajax({
                            url: document.url,
                            type: "get",
                            beforeSend: function () {
                                $('.load').html('<img src="{{asset('images/loader/loader-img.gif')}}">')
                            },
                            success: function (result) {
                                $('#add-product').replaceWith($('#add-product').html(result));
                                $('.load').remove();
                                $('.add-load').append('    <div class="load">\n' + '\n' + '                        </div>');
                            }
                        });

                    }


                }

                else {
                    if (scrollheight == calculate && counter < max_counter) {
                        console.log(scrollheight);

                        counter++;


                        $.ajax({
                            url: document.url,
                            type: "get",
                            beforeSend: function () {
                                $('.load').html('<img src="{{asset('images/loader/loader-img.gif')}}">')
                            },
                            success: function (result) {
                                $('#add-product').replaceWith($('#add-product').html(result));
                                $('.load').remove();
                                $('.add-load').append('    <div class="load">\n' + '\n' + '                        </div>');

                            }
                        });

                    }
                }


            });


        });


    </script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Jan 1, 2021 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

    <script type="text/javascript">

        $(document).on('click', '.add_to_wishlist', function (e) {
            e.preventDefault();
            var product = $(this).attr('data-product');
            $(this).delay(5000);
            var wishlistClass = '#wishlist_' + product;
            $(wishlistClass).addClass('remove_from_wishlist');
            $(wishlistClass).removeClass('add_to_wishlist');
        });

        $(document).on('click', '.remove_from_wishlist', function (e) {
            e.preventDefault();
            var product = $(this).attr('data-product');
            $(this).delay(5000);
            var wishlistClass = '#wishlist_' + product;
            $(wishlistClass).addClass('add_to_wishlist');
            $(wishlistClass).removeClass('remove_from_wishlist');
        });
    </script>
    <script>
        function sweetAlert(type, title, message) {
            swal({
                title: title,
                html: message,
                type: type,
                confirmButtonColor: '#ee3d43',
                timer: 3000
            }).catch(swal.noop);
        }

    </script>



@endsection
