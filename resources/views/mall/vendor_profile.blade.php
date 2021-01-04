@extends('layouts.app')
@section('title', 'Mission & Vision')
​
@section('content')
​
    <section class="vendor-profile">
​
        <div class="container">
            <div class="row">
    @if(isset($cover))
                    <div class="vendor-banner">
​
                        <img src="{{asset('vendor_cover_image/'.$cover->cover_image)}}" alt=""
                             style="height:100%;width:100%;object-fit:cover">
                    </div>
                @endif
            </div>
​
​
            <div class="row ">
                <div class="col-md-3 col-sm-12  bg-white">
                    <div class="vendor-profile-details">
                        <div class="vendor-image">
                            <figure>
                                @if($vendor->company_images != null && $vendor->company_images->first())
                                    <img src="{{asset('vendor_company_image/'.$vendor->company_images->first()->image)}}"
                                         alt="">
                                @else
                                    <img src="https://www.clpgroup.com/PublishingImages/section_photo/1.1.0companyprofile_mobile.jpg"
                                         alt="">
                                @endif
​
​
                            </figure>
                        </div>
                        <div class="vendor-info">
                            <P>Total Products:</P>
                            <div class="vendor-name">
                                {{-- <h2>{{$vendor->name}}</h2> --}}
                            </div>
                            <P>Average Rating:</P>
                            <div class="vendor-name">
                                {{-- <h2>{{$vendor->name}}</h2> --}}
                            </div>
                            <P>Total Orders:</P>
                            <div class="vendor-name">
                                {{-- <h2>{{$vendor->name}}</h2> --}}
                            </div>
                            <P>Seller Costumer Service helpline:</P>
                            <div class="vendor-name">
                                <h2>{{$vendor->primary_phone}}</h2>
                            </div>
                            <h3 class="pt-2">About Us:</h3>
                            <div class="vendor-about py-1">
                                <p>{{$vendor->description}}</p>
                            </div>
​
​
                        </div>
                    </div>
                    <div class="side-ads py-3">
                        @if(isset($advertise->image))
​
                            <img src="{{asset('storage/'.$advertise->image)}}" alt=" " style="width: 100%">
                        @endif
                    </div>
                </div>
                <div class=" col-md-9 col-sm-12">
                    <div class="vendor-profile-products box-shadow-xy">
                        <div class="vendor__right">
                            <div class="product_sort_by my-2 border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <ul class="d-flex">
                                                <li><a class="discount" href="Javascript:Void(0)">Discounts & Bargin</a></li>
                                                <li><a href="Javascript:Void(0)">|</a>
                                                </li>
                                                <li><a class="all" href="Javascript:Void(0)">All Products</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="d-flex ml-auto p-2">
                                            <select name="sort">
                                                <option value="popular" id="popular" >Popularity</option>
                                                <option value="low_to_high" id="low_to_high">Price low to high</option>
                                                <option value="high_to_low" id="high_to_low">Price high to low</option>
                                            </select>
                                            <div class="ml-2">
                                                <form class="uk-search uk-search-default">
                                                    <a href="" class="uk-search-icon-flip" uk-search-icon></a>
                                                    <input class="uk-search-input" type="search" placeholder="Search...">
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            <div class="product-category white-product" id="productData">
                                @foreach($products as $value)
​
                                    <article class="product instock sale purchasable">
                                        <div class="product-wrap">
                                            <div class="product-top">
                                                <figure>
                                                    <a href="{{ route('product.show', ['slug' => $value->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{$value->getImageAttribute()->mediumUrl}}"
                                                                 class="attachment-shop_catalog size-shop_catalog"
                                                                 alt="">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-description">
                                                <div class="product-meta">
                                                    <div class="title-wrap">
                                                        <p class="product-title">
                                                            <a href="{{ route('product.show', ['slug' => $value->slug]) }}">{{$value->name}}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-meta-container">
                                                    <div class="product-price-container">
                                <span class="price">
​
                                        <span class="Price-amount discount">
                                            <span class="Price-currencySymbol">Rs</span>{{$value->product_price}}
                                        </span>
​
​
                                        <span class="Price-amount amount">
                                            <span class="Price-currencySymbol">Rs</span>{{$value->sale_price}}</span>
​
                                </span>
                                                        <div class="save-upto">
                                                            <span>save upto 40%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
​
                                <div class="dummy"></div>
                                <div class="dummy"></div>
                                <div class="dummy"></div>
                                <div class="dummy"></div>
                                <div class="dummy"></div>
                            </div>
                        </div>
                        <section id="pagination">
​
​
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    {{$products->render()}}
​
                                </ul>
                            </nav>
                        </section>
                    </div>
                </div>
            </div>
        </div>
​
    </section>
​
@endsection
@section('extra_scripts')
    <script>
        $(document).ready(function () {
            $('#low_to_high').click(function () {
                $.ajax({
                    url: document.url,
                    type: 'get',
                    data: {
                        lowtohigh: high,
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });
​
            $('#high_to_low').click(function () {
                var high = '';
                $.ajax({
                    url: document.url,
                    type: 'get',
                    data: {
                        hightolow: high,
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });
​
            $('#popular').click(function () {
                var high = '';
                $.ajax({
                    url: document.url,
                    type: 'get',
                    data: {
                        popularity: high
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });
            $('.all').click(function () {
                var high = '';
                console.log(high);
                $.ajax({
                    url: document.url,
                    type: 'get',
                    data: {
                        popularity: high
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });
            $('.discount').click(function () {
                var high = '';
                $.ajax({
                    url: document.url,
                    type: 'get',
                    data: {
                        discount: high
                    },
                    success: function (result) {
                        $('#productData').replaceWith($('#productData').html(result));
                    }
                });
            });
​
        });
    </script>
@endsection