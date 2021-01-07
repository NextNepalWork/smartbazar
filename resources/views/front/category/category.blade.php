@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')


    {{--<section id="category-filter" class="category-filter">--}}
    {{--<div class="container-fluid bg-white relative">--}}
    {{--<div class="cat-overlay"></div>--}}
    {{--<div class="d-flex custom--row relative" style="width: 100%">--}}


    {{--<aside class="left__side mb">--}}
    {{--<div class="filter-section mb">--}}
    {{--<div class="filter-title d-flex justify-content-between">--}}
    {{--<div class="heading">--}}
    {{--<h3>Filter</h3>--}}
    {{--</div>--}}
    {{--<a href="" class="blue_link">Clear</a>--}}
    {{--</div>--}}

    {{--<div class="filter-result">--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--<ul uk-accordion="collapsible: false">--}}
    {{--@include('front.category.filter.category',['categorys'=>$similarCategory])--}}

    {{--@if($products->count()>0)--}}
    {{--@if(isset($brands))--}}
    {{--@include('front.category.filter.brands',['brands'=>$brands])--}}
    {{--@endif--}}
    {{--@include('front.category.filter.discount')--}}
    {{--@if(isset($size))--}}
    {{--@include('front.category.filter.size')--}}
    {{--@endif--}}
    {{--@if(isset($colour) && $colour->isNotEmpty())--}}
    {{--@include('front.category.filter.colour',['colour'=>$colour])--}}
    {{--@endif--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--<div class="done-filter">--}}
    {{--<button class="btn view-cart">Done</button>--}}
    {{--</div>--}}
    {{--</aside>--}}
    {{--<div class="  right--side ">--}}
    {{--<section class="breadcrumbs ">--}}
    {{--<ul class="uk-breadcrumb">--}}
    {{--<li><a href="{{ route('home.index') }}">Home</a></li>--}}
    {{--<li><a href="#">Category</a></li>--}}
    {{--<li><span>{{ $title }}</span></li>--}}
    {{--</ul>--}}
    {{--</section>--}}
    {{--<div class="Name__of__category mt-2 d-flex justify-content-between border-bottom align-items-center">--}}

    {{--<div class="heading d-flex align-items-center">--}}
    {{--<h3>{{ $title }} </h3><span class="text-muted">(showing {{ count($products) }}--}}
    {{--products)</span>--}}
    {{--</div>--}}
    {{--<div class="product-sort d-flex align-items-center py-1">--}}
    {{--<div class="d-flex justify-content-end align-items-center">--}}
    {{--<h4 style="white-space: nowrap">--}}
    {{--SORT BY:--}}
    {{--</h4>--}}
    {{--<!--<ul class="d-flex ">-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="popular" href="#">Popularity</a></li>-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="low-high" href="#">Price low to high</a></li>-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="high-low" href="#">Price high to low</a></li>-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="new" href="#">Newest Items</a></li>-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="a-z" href="#">Alphabetical: A to Z</a></li>-->--}}
    {{--<!--    <li><a class="item_filter" data-sort="z-a" href="#">Alphabetical: Z to A</a></li>-->--}}
    {{--<!--</ul>-->--}}
    {{--<form action="{{ Request::fullUrl()}}" method="get">--}}
    {{--<!--<label for="sort"></label>-->--}}
    {{--<select class="uk-select ml-1 item_filter" name="sort" id="sort">--}}
    {{--<option class="item_filter" value="popular" selected>Popular Items</option>--}}
    {{--<option class="item_filter" value="new">Newest Items</option>--}}
    {{--<option class="item_filter" value="old">Oldest Items</option>--}}
    {{--<option class="item_filter" value="a-z">Alphabetical: A to Z</option>--}}
    {{--<option class="item_filter" value="z-a">Alphabetical: Z to A</option>--}}
    {{--<option class="item_filter" value="low-high">Price: Low to High</option>--}}
    {{--<option class="item_filter" value="high-low">Price: High to Low</option>--}}
    {{--</select>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class=" d-none" id="btn-filter">--}}
    {{--<p class="btn view-cart">Filter <span class="text-white">(0)</span></p>--}}
    {{--</div>--}}

    {{--</div>--}}

    {{--<div class="product-category white-product cat-page" id="productData">--}}
    {{--<div class="inner-column" style="display:flex;">--}}
    {{--@if($products->count()>0)--}}
    {{--@foreach($products as $product)--}}
    {{--<article class="product instock sale purchasable">--}}
    {{--<div class="product-wrap">--}}
    {{--<div class="product-top">--}}

    {{--<figure>--}}
    {{--<a href="{{ route('product.show', ['slug' => $product->slug]) }}">--}}
    {{--<div class="product-image">--}}
    {{--<img width="320" height="320"--}}
    {{--src="{{ $product->getImageAttribute()->mediumUrl }}"--}}
    {{--class="attachment-shop_catalog size-shop_catalog"--}}
    {{--alt="{{ $product->name }}">--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--</figure>--}}
    {{--</div>--}}
    {{--<div class="product-description">--}}
    {{--<div class="product-meta">--}}
    {{--<div class="title-wrap">--}}
    {{--<p class="product-title">--}}
    {{--<a href="{{ route('product.show', ['slug' => $product->slug]) }}"--}}
    {{--class="line-clamp1">{{ $product->name }}</a>--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="product-meta-container">--}}
    {{--<div class="product-price-container">--}}
    {{--<span class="price">--}}
    {{--<span class="Price-amount amount">--}}
    {{--<span class="Price-currencySymbol">Rs</span>{{ number_format($product->sale_price) }}</span>--}}
    {{--<span class="Price-amount discount">--}}
    {{--<span class="Price-currencySymbol">Rs</span>{{ number_format($product->product_price) }}--}}
    {{--</span>--}}

    {{--</span>--}}
    {{--<div class="save-upto">--}}
    {{--@if($product->product_price>5)--}}
    {{--@php--}}
    {{--$discount = $product->product_price-$product->sale_price;--}}
    {{--$discount_percentage = $discount/$product->product_price*100;--}}
    {{--@endphp--}}
    {{--<span class="product-label discount">-{{ number_format($discount_percentage)}}--}}
    {{--%</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</article>--}}
    {{--@endforeach--}}
    {{--@else--}}
    {{--<div class="product-category white-product">--}}
    {{--<div class="alert alert-danger alert-status text-center">No Products Found</div>--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <section id="category-filter" class="category-filter">
        <div class="container-fluid bg-white relative">
            <div class="cat-overlay"></div>
            <div class="d-flex custom--row relative" style="width: 100%">
                <aside class="left--side mb">
                    <div class="filter-section mb">
                        <div class="filter-title d-flex justify-content-between">
                            <div class="heading">
                                <h3>Filter</h3>
                            </div>
                           
                        </div>

                        <div class="filter-result">

                        </div>
                    </div>
                    <ul uk-accordion="collapsible: false">
                        @include('front.category.filter.category',['categorys'=>$similarCategory])
                        @if($products->count()>0)
                            @if(isset($brands))
                                @include('front.category.filter.brands',['brands'=>$brands])
                            @endif
                            @include('front.category.filter.discount')
                            @if(isset($size))
                                @include('front.category.filter.size')
                            @endif
                            @if(isset($colour) && $colour->isNotEmpty())
                                @include('front.category.filter.colour',['colour'=>$colour])
                            @endif
                        @endif
                    </ul>
                    <div class="done-filter">
                        <button class="btn view-cart">Done</button>
                    </div>
                </aside>


                <div class="  right--side ">
                    <section class="breadcrumbs ">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li><span>{{ $title }}</span></li>
                        </ul>
                    </section>
                    <div class="Name__of__category mt-2 d-flex justify-content-between border-bottom align-items-center">
                        <div class="heading d-flex align-items-center">
                            <h3>{{ $title }} </h3><span class="text-muted">(showing {{ count($products) }}
                                products)</span>
                        </div>
                        <div class="product-sort d-flex align-items-center py-1 pr-5">
                            <h4 style="white-space: nowrap">
                                SORT BY:
                            </h4>
                            <div class="dropdown">
                                <button class="btn btn-outline-default dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:#fff; border:1px solid #ccc">
                                    Select Here
                                </button>
                                <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButton">
                                    <li><a class="item_filter" data-sort="popular" href="#">Popularity</a></li>
                                    <li><a class="item_filter" data-sort="low-high" href="#">Price low to high</a></li>
                                    <li><a class="item_filter" data-sort="high-low" href="#">Price high to low</a></li>
                                    <li><a class="item_filter" data-sort="new" href="#">Newest Items</a></li>
                                    <li><a class="item_filter" data-sort="a-z" href="#">Alphabetical: A to Z</a></li>
                                    <li><a class="item_filter" data-sort="z-a" href="#">Alphabetical: Z to A</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=" d-none" id="btn-filter">
                            <p class="btn view-cart">Filter <span class="text-white">(0)</span></p>
                        </div>

                    </div>
                    <div class="product-category white-product">

                        @include('front.category.product',['product' => $products])

                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>
                        <div class="dummy"></div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <div id="quickview-modal" class="product-description" uk-modal>
    </div>

    <style>
        #loaderpro {
            text-align: center;
            background: url({{ asset('uploads/giphy.gif') }}) no-repeat center;
            height: 150px;
        }
    </style>

@endsection
@section('extra_scripts')

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


        $(document).on('click', '.item_filter', function () {
            $('#productData').html('<div id="loaderpro" style="" ></div>');
            colour = multiple_values('colour');
            brand = multiple_values('brand');
            size = multiple_values('size');
            sort = $(this).attr('data-sort');
            $.ajax({
                url: document.URL,
                type: 'get',
                data: {
                    colour: colour,
                    brand: brand,
                    size: size,
                    // sort: $("#sort").val(),
                    sort: sort,
                    maxprice: $("#max").val(),
                    minprice: $("#min").val()
                },
                success: function (result) {
                    $('#productData').replaceWith($('#productData').html(result));
                }
            });
        });

        function multiple_values(inputclass) {
            var val = new Array();
            $("." + inputclass + ":checked").each(function () {
                val.push($(this).val());
            });
            return val;
        }

        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 10,
                max: 100000,
                values: [5000, 30000],
                slide: function (event, ui) {
                    $("#amount").val("Min : Rs" + ui.values[0] + " - Max : Rs" + ui.values[1]);
                    $("#min").val(ui.values[0]);
                    $("#max").val(ui.values[1]);

                    $('.product-data').html('<div id="loaderpro" style="" ></div>');
                    colour = multiple_values('colour');
                    brand = multiple_values('brand');
                    size = multiple_values('size');
                    $.ajax({
                        url: document.URL,
                        type: 'get',
                        data: {
                            colour: colour,
                            brand: brand,
                            size: size,
                            sort: $("#sort").val(),
                            maxprice: $("#max").val(),
                            minprice: $("#min").val()
                        },
                        success: function (result) {
                            $('#productData').replaceWith($('#productData').html(result));
                        }
                    });
                }
            });
            $("#amount").val("Min : Rs" + $("#slider-range").slider("values", 0) +
                " - Max : Rs" + $("#slider-range").slider("values", 1));
        });
    </script>


@endsection