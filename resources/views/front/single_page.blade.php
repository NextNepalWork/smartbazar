@extends('layouts.app')
@section('title',"Product Name")

@section('extra_styles')
    <style>
        .select_quantity {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            flex-wrap: nowrap;
        }

        .select_quantity h1 {
            color: #212121;
            font-size: 22px;
            font-weight: 700;
            /*margin-bottom: 11px;
            margin-top: 13px;*/
        }

        .select_quantity .form {
            margin-left: 15px;
            padding: 0 5px;
        }

        .select_quantity .form:focus {
            outline: none;
        }
        #single-page .buttons__for{
            flex-wrap: wrap;
        }
        #single-page .buttons__for .button__addtocart__link{
            margin: 0 5px;
            padding: 5px 10px;
        }
        #single-page .buttons__for .button__buynow__link {

            margin: 0 5px;
            padding: 5px 10px;
        }
        #single-page .buttons__for .button_order_by_call {
            text-align: center;
            background: #FF0000;
            color: white;
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 0;
            -webkit-box-shadow: 1px 3px 3px 0 rgba(0, 0, 0, 0.33);
            box-shadow: 1px 3px 3px 0 rgba(0, 0, 0, 0.33);
        }
        #single-page .buttons__for .button_order_by_viber {
            text-align: center;
            background: #665CAC;;
            color: white;
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 0;
            -webkit-box-shadow: 1px 3px 3px 0 rgba(0, 0, 0, 0.33);
            box-shadow: 1px 3px 3px 0 rgba(0, 0, 0, 0.33);
        }
    </style>
@endsection
@section('content')

    <section id="single-page">

        <div class="container bg-white py-3">

            <div class="row mx-0 mb-4">

                <div class="row">
                    <div class="d-sm-block d-md-none mb ">
                        <section class="breadcrumbs ">
                            <ul class="uk-breadcrumb">
                                <li><a href="{{ route('home.index') }}">Home</a></li>
                                <li><span>{{ $product->name }}</span></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-md-12 d-none d-md-block mb-4">
                        <section class="breadcrumbs ">
                            <ul class="uk-breadcrumb">
                                <li><a href="{{ route('home.index') }}">Home</a></li>
                                @foreach($product->categories as $category)
                                    @if($category->parent_id != 0)
                                        @php
                                            $parent = App\Model\Category::where('id', $category->parent_id)->first();
                                        @endphp
                                        @if($parent->parent_id != 0)
                                            @php
                                                $cat = App\Model\Category::where('id', $parent->parent_id)->first();
                                            @endphp
                                            @if($cat->parent_id != 0)
                                                @php
                                                    $sub = App\Model\Category::where('id', $cat->parent_id)->first();
                                                @endphp
                                                <li><a href="{{ route('category', $sub->slug) }}">{{ $sub->name }}</a>
                                                </li>
                                            @endif
                                            <li><a href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a></li>
                                        @endif
                                        <li><a href="{{ route('category', $parent->slug) }}">{{ $parent->name }}</a>
                                        </li>
                                    @endif
                                    <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                <li><span>{{ $product->name }}</span></li>
                            </ul>
                        </section>
                    </div>

                    <div class=" col-lg-5 col-md-6">
                        <div class="xzoom-container" style="z-index: 980;text-align:center">
                            <div class="default__zoom">
                                <div class="image__zoom">
                                    <img class="xzoom4" id="xzoom-fancy"
                                         src="{{ $product->getImageAttribute()->mediumUrl }}"
                                         xoriginal="{{ $product->getImageAttribute()->url }}"/>
                                </div>

                            </div>

                            <div class="xzoom-thumbs">
                                @foreach($product->getProductGallery() as $image)
                                    <a href="{{ $image->url }}">
                                        <img class="xzoom-gallery4" @if($loop->first) src="{{ $image->smallUrl }}"
                                             xpreview="{{ $image->mediumUrl }}"
                                             @else src="{{ $image->mediumUrl }}" @endif>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <!--<div class="buttons__for mb">-->

                        <!--    <div class="button__addtocart">-->
                        <!--        <a class="btn btn-default button__addtocart__link addtocart"-->
                    <!--           data-product="{{ $product->id }}" href="#">-->
                        <!--            <span>Add to cart</span></a>-->
                        <!--    </div>-->
                        <!--    <div class="button__buynow">-->
                        <!--        <a class="btn btn-default button__buynow__link buynow"-->
                    <!--           data-product="{{ $product->id }}" href="#">-->
                        <!--            <span>Buy Now</span></a>-->
                        <!--    </div>-->


                        <!--</div>-->
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="summary entry-summary product-details">
                            <h1 class="product_title entry-title">
                                <a href="">{{ $product->name }}</a>
                            </h1>
                            <div class="shear-brand">

                                <div class="product-rating">
                                    <div class="d-flex">
                                        <p>
                                            Seller: @if(isset($shop_name) && App\Model\VendorDetail::where('user_id', $product->user_id)->first())

                                                {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                            @else
                                                {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                            @endif</p>
                                    </div>
                                    <div class="d-flex">
                                        <p><img src="{{asset('front/img/house.png')}}" alt=""
                                                style="margin-bottom: 9px"> Visit Store</p>
                                    </div>
                                    <div class="d-flex">

                                        <div class="star-rating">
                                        <span style="width:100%">
                                            @for( $i=0;$i<$product->getAverageRating();$i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </span>
                                        </div>
                                        <a href="#reviews" class="review-link">(<span
                                                    class="count">{{$product->reviews->where('status',1)->count()}}</span>
                                            customer
                                            review)
                                        </a>

                                    </div>

                                    <div class="button__wish">
                                        <a href="" uk-icon="heart" class="addtowishlist"
                                           data-product="{{ $product->id }}" uk-tooltip="Add To Wishlist"></a>
                                    </div>
                                </div>
                            <!--@if($product->approved == 1)-->
                                <!--    <div class="product-approved-container mt-2">-->
                                <!--        <span class="approved_title">APPROVED BY</span>-->
                                <!--        <span class="approved_by badge badge-success">Smart Bazar</span>-->
                                <!--    </div>-->
                                <!--@endif-->
                                {{-- <div class="seller_name d-flex align-items-center py-2 ">
                                   <h5> Seller:</h5>&nbsp;
                                   @if(isset($shop_name) && App\Model\VendorDetail::where('user_id', $product->user_id)->first())


                                       <p class=""><a class="badge badge-success p-2"
                                                   href="{{$product->users->vendorDetails != null ? route('profile',$product->users->vendorDetails->name):''}}">{{ isset($shop_name) ? $shop_name : $product->users->first_name }}</a>
                                       </p>
                                   @else
                                       <p ><a
                                                   href="#">{{ isset($shop_name) ? $shop_name : $product->users->first_name }}</a>
                                       </p>
                                   @endif
                               </div> --}}
                                <div class="product-price-container">
                                    <!--<span class="d-block">Special price</span>-->
                                    <p class="price">
                                    <span class="Price-amount amount">
                                        <span class="Price-currencySymbol">Rs.</span>{{ $product->sale_price ? $product->sale_price : $product->product_price }}
                                    </span>
                                        @if(isset($product->product_price))
                                            <span class="Price-amount discount">
                                        <span class="Price-currencySymbol">Rs.</span>{{ $product->product_price ? $product->product_price : '' }}
                                    </span>
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

                                        </p>


                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @if($product->stock_quantity == 0 && $product->stock == 0 && $product->prebooking == 0)
                                <div class="notify-users">
                                    <div>
                                        <h2 class="text-success">Sold Out</h2>
                                        <h4>This item is currently out of stock</h4>
                                        <form action="{{ route('notify.stock') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                                                 style="display: inline-block;">
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="Enter email to get notified" required>
                                                @if($errors->has('email'))
                                                    <span class="help-block">
                                                    {{ $errors->first('email') }}
                                                </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-danger">Notify me</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                @if($product->features->isNotEmpty())
                                    <div class="product-details__short-description uk-margin-top mb">
                                        <ul>
                                            @foreach($product->features->slice(0,5) as $feature)
                                                <li><i class="fas fa-tag"></i>{{ $feature->feature }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="delivery_address d-flex align-items-center py-2">
                                    <h5> Delivery</h5>:&nbsp;
                                    <div class="delivery_location">
                                        {{-- <form action="" class="d-flex flex-wrap">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <input type="text">
                                            <button type="submit" style="color:white; background:#f25548; padding: 5px; border:none; margin:5px 0; cursor: pointer;">
                                                find now
                                            </button>
                                        </form> --}}
                                        <p>Usually delivered in {{ $product->from }}-{{ $product->to }} days</p>
                                    </div>
                                </div>
                                <div class="select_quantity py-3">
                                    <h1>Quantity :</h1>
                                    <input class="form" type="number" id="quantity" name="quantity" min="1"
                                           max="{{ $product->stock_quantity }}"
                                           placeholder="1">
                                </div>
                            @endif
                            {{-- <div class="product-quantity quantity d-flex align-items-center py-2">
                                <h5>Quantity </h5>
                                <div>
                                    <input type="number" class="form-control" id="quantity" value="1" min="1" max="{{$product->stock_quantity}}" size="4">
                                </div>
                            </div> --}}
                            @if(count($products) > 1)
                                <div class="color_option d-flex align-items-center py-2  ">
                                    <h5> Colors</h5>
                                    <div class="custom-radios_for_colors">
                                        @foreach( $products as $relation)
                                            <div>
                                                <input type="radio" id="color-{{$loop->index}}" name="colour" value="">
                                                <label class="grey" for="color-{{$loop->index}}"
                                                       @if($product->id == $relation->id) style="border: 2px solid dodgerblue;" @endif>
                                            <span>
                                                <span class="color_option_list"><a
                                                            href="{{ route('product.show', $relation->slug) }}"><img
                                                                src="{{ $relation->getImageAttribute()->smallUrl }}"
                                                                alt=""></a></span>
                                                {{-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" /> --}}
                                            </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if (!empty($sizes))
                                <div class="size_option d-flex align-items-center py-2 ">
                                    <h5> Size</h5>
                                    <div class="custom-radios">
                                        @foreach(array_unique($sizes) as $size)
                                            <div>
                                                <input type="radio" id="size-{{$loop->index}}" name="size"
                                                       value="{{ $size }}">
                                                <label class="grey" for="size-{{$loop->index}}">
                                            <span>
                                                <div class="text">{{ $size }}</div>
                                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg"
                                                     alt="Checked Icon"/>
                                            </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <select id="select_size" class="uk-select">
                                        <option disabled="">select Size</option>
                                        @foreach(array_unique($sizes) as $size)
                                            <option value="{{ $size }}">{{ $size }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            @endif

                            <div class="buttons__for top-buttons mb">

                                <div class="button__addtocart  mb-2">
                                    <a class="btn btn-default button__addtocart__link addtocart"
                                       data-product="{{ $product->id }}" href="#">
                                        <i class="mr-2">
                                            <svg height="20" width="20" aria-hidden="true" focusable="false"
                                                 data-prefix="fab" data-icon="opencart"
                                                 class="svg-inline--fa fa-opencart fa-w-20" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path fill="currentColor"
                                                      d="M423.3 440.7c0 25.3-20.3 45.6-45.6 45.6s-45.8-20.3-45.8-45.6 20.6-45.8 45.8-45.8c25.4 0 45.6 20.5 45.6 45.8zm-253.9-45.8c-25.3 0-45.6 20.6-45.6 45.8s20.3 45.6 45.6 45.6 45.8-20.3 45.8-45.6-20.5-45.8-45.8-45.8zm291.7-270C158.9 124.9 81.9 112.1 0 25.7c34.4 51.7 53.3 148.9 373.1 144.2 333.3-5 130 86.1 70.8 188.9 186.7-166.7 319.4-233.9 17.2-233.9z"></path>
                                            </svg>
                                        </i>
                                        <span>Add to cart</span></a>
                                </div>
                                <div class="button__buynow mb-2">
                                    <a class="btn btn-default button__buynow__link buynow"
                                       data-product="{{ $product->id }}" href="#">
                                        <i class="mr-2">
                                            <svg height="20" width="20" aria-hidden="true" focusable="false"
                                                 data-prefix="fas" data-icon="shopping-bag"
                                                 class="svg-inline--fa fa-shopping-bag fa-w-14" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path fill="currentColor"
                                                      d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z"></path>
                                            </svg>
                                        </i>
                                        <span>Buy Now</span></a>
                                </div>
                                <div class="mb-2 order_by_call_btn">
                                    <a class="btn button_order_by_call" href="tel:+977 9843158452">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>Order by Phone</span></a>
                                </div>

                                <div class="mb-2 order_by_viber_btn">
                                    <a class="btn button_order_by_viber" href="#">
                                        <i class="fab fa-viber"></i>
                                        <span>Order by Viber</span></a>
                                </div>


                            </div>
                            @if($product->negotiable == 1)
                                <div class="bargain mb py-3 border-top ">
                                    <div class="heading  pb-2 mb-2">
                                        <h3>Bargain With Seller</h3>
                                        <p class="text-muted"> You Offer your price to this items</p>
                                    </div>
                                    <form action="{{route('negotiable.create')}}" class="d-flex" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        {{--<input type="hidden" name="fixed_price" value="{{$product->sale_price}}">--}}


                                        {{--<input type="number" id="bargain"--}}
                                        {{--class="form-control input-text uk-input w-75 text d-inline-block"--}}
                                        {{--name="bargain_price" title=""--}}
                                        {{--placeholder="enter Price lower than item">--}}
                                        <button type="submit" class="btn view-cart">
                                        <span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="21.68"
                                                                height="19.973" viewBox="0 0 800 737">
                                        <image width="800" height="737"
                                               xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAUCAYAAACJfM0wAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH5AIFDDYfARE1ggAABKNJREFUOMuNVEtoXVUUXeec+3nvvl/ykjapDf3FUghalKL0MxALVlsEHYgiigMHFnWiaEFasApVCxVbUUFwpjMnVmkVHIlFoRZMJ9oWaiyxMaR5L/e+++7v3PPZDtLENi3igjM57LP2Zu2zFogI1lokSYIwDBHH/ZGy1MeNpQ7dAEtExtC1stTH+v1k1WJtDGstiOiWw4gIxhgURcF9v3LKccRewELJ6HddZt8bFU4DgPCH1ztO5RHXa24BE1DafFnk2VNBEEAIgZVg1ydexzi/wGCDfvjHwSLtvmdMDjABYTsACOSOwZocgnuoNkbfrrc2vknE5onsBOe8cwuxMcbjnIeApvmr5+6QxULsV1rg3AUXHDB9kDWAMwQiBaslShmjWhte215z31VATFlrxznnNxFzAj8BUFCEZycczMWe50NrCd8zGBzwQWSQFwWYXUCrloPzEpwLCEQzOjl/D4BNxrI3sixDURTI8xxZloEREcn0ytdp9+zj1UoFxtn4GJyR3Q7NHq24+Wwqg32WDT2E8vLRqtubk2zz48RaOz02faTM52K/tWOSeSOrooXOGOccWmsIIeAAgEymzqmiC7+xa1t9cOtJAChT2QyjSy8OrNnxDWMQZUZens0cbgxPfAUAMqW1WRE947f4rw7H8wCQ5zlarRaq1So4ADj+SJvEEKxFviy+4xeOWy0AIwGAca9g3Ev/FbGRElwAehiATpIEWZYxx3EE5xxMG5qCiWx87ec7GwOjUKa5vZBsW1DzPvcD3o87c9uUqdzfqNkvvPpQkkTZ9qIo7w6q9jMHPTi1rQRRP93tzD9ar9dPu647wxh7gZXKvOQ6/JOy98uDSnZ/KMwQ8kJjYLCNeqOJazO/Ic8kVo2OoRKMIOzOIInn0aiVaI/cewTuukNK6wmt1IVKpRIxxlpa6yeZMQac84uA2dKZObve6ni61Wojl4RSpqjWVoOJCrL4L4D50DoDZ4Rme/NbQXPDYQAfGGNeI6KDjuO8AwBa6zPXDUIDjLFLAK0ukiuvCPv3h2mmIIsCzfYmcOEjnL+ISjDaEG7liVpz7H3h1Npa6xNKqVc9z9sphPhpSX4iWoDWGmUpEUURtKHzugzD2amTSKLLz1kjyZpCWSMjozO7nBuW/kySZFO320Ucx7uttXRTrlgbOmVZLi6ZcxAQWZVcbQxueb3WGj9mDCYBe4aAwbLEjNHpd8aoH40xEEKgVqt97Pv+yyvtbK29DKUUlFLQWt+12E4REZGU5cHp6Wl0Oh2EYYjZ2Vl0Oh0vSZK9UsqTK6e8EWVZ7odSCmVZwlr7KRGR1ubbJEnGe70e0jRFnufHtdb0f6GU+sgYAxhjQEQoimJrr9cbj+MYURQhTVMQEdI0RZZlB4joP9mttdTr9Z7u9/uw1oJZa8EYQ57nyPMcvu/DWgshBIIgQJZlkFKCc86FEPtc133AGLOm1+ul7XZ7g+/7e67/BIRhOA5gSgiB5axjjGFl9C27d/HeSilP5Xl+oNvtPjs5Obk/DMOHrbXvLr2v1+t7Pc+D4zi4PdNtsNRYCAHHcVCtViGEQJZlh9I03UVEUgixZ6n+H1RgXlwUutOSAAAAAElFTkSuQmCC"/>
                                        </svg></span>
                                            Bargain
                                        </button>
                                    </form>
                                    <span class="text-danger">{{ $errors->first('bargain_price') }}</span>

                                </div>
                            @endif
                            @if($product->prebooking == 0)
                                @if($product->stock_quantity != 0 && $product->stock != 0)
                                    {{--<div class="buttons__for mb desktop">--}}
                                    {{--<div class="button__addtocart">--}}
                                    {{--<a class="btn btn-default button__addtocart__link addtocart" data-product="{{ $product->id }}" href="#">--}}
                                    {{--<img src="http://i68.tinypic.com/2rm38rr.png" style=" width: 24px; margin-right: 5px; "--}}
                                    {{--alt="">--}}
                                    {{--<span>Add to cart</span></a>--}}
                                    {{--</div>--}}
                                    {{--<div class="button__buynow">--}}
                                    {{--<a class="btn btn-default button__buynow__link buynow" data-product="{{ $product->id }}" href="#">--}}
                                    {{--<img src="http://i65.tinypic.com/2rw7xpc.png" style="width: 20px;margin-right: 5px;"--}}
                                    {{--alt="">--}}
                                    {{--<span>Buy Now</span></a>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                @endif
                            @else
                                <div class="buttons__for mb desktop col-md-6 p-0">
                                    <div class="button__addtocart" style="width:100%">
                                        <a class="btn btn-default button__addtocart__link buynow"
                                           data-product="{{ $product->id }}" href="#" style="width:100%">
                                            <span>Prebooking</span></a>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>


                </div>

                <div class="row mt-5">
                    <div class="col-sm-12">
                        <div id="product__detail__description" style=" background: #fcfcfc;">
                            <ul class="nav nav-tabs" id="descriptionTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product"
                                       role="tab"
                                       aria-controls="product" aria-selected="true">Product Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="seller-tab" data-toggle="tab" href="#seller" role="tab"
                                       aria-controls="seller" aria-selected="false">Seller Information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="product" role="tabpanel"
                                     aria-labelledby="product-tab">
                                    <div class="product__detail__description box-shadow p-4 mb mt-3">
                                        <div class="product__name heading">
                                            <h3>
                                                Product detail of {{ $product->name }}
                                            </h3>
                                        </div>
                                        <hr>

                                        <div class="product_information_list mb">
                                            {!! $product->long_description !!}
                                        </div>

                                        @if($product->features->isNotEmpty())
                                            <div class="product_information_list mb">
                                                <ul>
                                                    @foreach($product->features as $feature)
                                                        <li class="">{{ $feature->feature }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if($product->specifications->isNotEmpty())
                                            <div class="product-desc-list">
                                                @foreach($product->specifications as $specification)
                                                    <div class="details-desc">
                                                        <span class="details-desc-title">{{ $specification->title }}</span>
                                                        <span class="desc-list-item">{{ $specification->description }}</span>
                                                        <span class="clearfix"></span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="seller" role="tabpanel" aria-labelledby="seller-tab">
                                    <div class="product__detail__description box-shadow p-4 mb mt-3">
                                        <div class="product__name heading">
                                            <h3>
                                                @if(isset($shop_name) && App\Model\VendorDetail::where('user_id', $product->user_id)->first())
                                                    {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                                @else
                                                    {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                                @endif
                                            </h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3><img src="{{asset('front/img/house.png')}}" alt=""
                                                         style="margin-bottom: 9px">
                                                    @if(isset($shop_name) && App\Model\VendorDetail::where('user_id', $product->user_id)->first())

                                                        {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                                    @else
                                                        {{ isset($shop_name) ? $shop_name : $product->users->first_name }}
                                                    @endif
                                                </h3>
                                                <hr>
                                                <b>Total Products: 200</b>
                                                <hr>
                                                <b>Average Ratings: 82.2%</b>
                                                <hr>
                                                <b>Total Orders: 200</b>
                                                <hr>
                                                <b>Seller Customer Service
                                                    Helpline: @if( App\Model\VendorDetail::where('user_id', $product->user_id)->first())
                                                        {{App\Model\VendorDetail::where('user_id', $product->user_id)->first()->primary_phone}}
                                                    @else
                                                        {{isset($product->users->phone)?$product->users->phone:''}}
                                                    @endif</b>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product_information_list mb">
                                                    <h2>About Us</h2>
                                                    <p class="pb-4 mb-3">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                        Accusantium
                                                        amet
                                                        beatae, commodi culpa debitis dignissimos ducimus eligendi ex
                                                        facilis
                                                        hic ipsa,
                                                        molestiae molestias quis sit totam unde vel veritatis voluptate.
                                                    </p>
                                                    <ul class="seller">


                                                        <li><span>Location</span>:
                                                            <span>
                                                                 @if( App\Model\VendorDetail::where('user_id', $product->user_id)->first())
                                                                    {{App\Model\VendorDetail::where('user_id', $product->user_id)->first()->address}}

                                                                @endif
                                                         </span></li>
                                                        <li><span>Email</span>:
                                                            <span>{{isset($product->users->email)? $product->users->email :''}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- product review -->
                            <div id="product__review ">
                                <div class="box-shadow mb p-4" style=" background: white;">
                                    <div class="product__review__name heading">
                                        <h3>
                                            Reviews of {{ $product->name }}
                                        </h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('review.post') }}" method="post" class="review-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="" style="padding: 10px 0px;">
                                            <span class="review--heading">Customer review</span>
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="stars" value="5"/>
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="stars" value="4"/>
                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3" name="stars" value="3" checked/>
                                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" name="stars" value="2"/>
                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1" name="stars" value="1"/>
                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                            </fieldset>
                                            <div class="clearfix"></div>
                                        </div>
                                        <p class="comment">write something</p>
                                        <textarea type="text" name="review" class="form-control" id="comment"
                                                  placeholder="write something"
                                                  rows="3" cols="100">
                                    </textarea>
                                        <button class="btn view-cart " type="submit"> comment</button>
                                        <div class="clearfix"></div>
                                    </form>
                                    <div class="clearfix"></div>

                                    @if( $product->reviews->where('status', 1)->isNotEmpty())
                                        @php
                                            if($product->reviews->isNotEmpty())
                                            {
                                            $total = $product->reviews->count();
                                            $five = ($product->reviews->where('stars', 5)->count() / $total) * 100;
                                            $four = ($product->reviews->where('stars', 4)->count() / $total) * 100;
                                            $three = ($product->reviews->where('stars', 3)->count() / $total) * 100;
                                            $two = ($product->reviews->where('stars', 2)->count() / $total) * 100;
                                            $one = ($product->reviews->where('stars', 1)->count() / $total) * 100;
                                            $average = (($product->reviews->where('stars', 5)->count() * 5) +
                                                        ($product->reviews->where('stars', 4)->count() * 4) +
                                                        ($product->reviews->where('stars', 3)->count() * 3) +
                                                        ($product->reviews->where('stars', 2)->count() * 2) +
                                                        ($product->reviews->where('stars', 1)->count() * 1)) / $total;
                                        }
                                        @endphp
                                        <p class="review-user">{{ number_format($average, 1) }} average based
                                            on {{ $product->reviews->count() }} reviews.</p>
                                        <hr style="border:3px solid #f1f1f1; width:70%">
                                        <div class="row review-rating">
                                            <div class="side">
                                                <div>5 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5"
                                                         style="width: {{ number_format($five, 2) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>{{ $product->reviews->where('stars', 5)->count() }}</div>
                                            </div>
                                            <div class="side">
                                                <div>4 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-4"
                                                         style="width: {{ number_format($four, 2) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>{{ $product->reviews->where('stars', 4)->count() }}</div>
                                            </div>
                                            <div class="side">
                                                <div>3 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-3"
                                                         style="width: {{ number_format($three, 2) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>{{ $product->reviews->where('stars', 3)->count() }}</div>
                                            </div>
                                            <div class="side">
                                                <div>2 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-2"
                                                         style="width: {{ number_format($two, 2) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>{{ $product->reviews->where('stars', 2)->count() }}</div>
                                            </div>
                                            <div class="side">
                                                <div>1 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-1"
                                                         style="width: {{ number_format($one, 2) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>{{ $product->reviews->where('stars', 1)->count() }}</div>
                                            </div>
                                        </div>
                                        <div class="review-container">
                                            <h3 class="review-title">Reviews</h3>
                                            @foreach($product->reviews->where('status', 1) as $review)
                                                <article class="reviews">
                                                    <figure class="user-image" style="width: 45px;">
                                                        <img src="{{ $review->users->getImage() ? $review->users->getImage()->smallUrl : asset('/front/img/default-product.jpg') }}"
                                                             alt="{{ $review->users->first_name . ' ' . $review->users->last_name }}"
                                                             title="{{ $review->users->first_name . ' ' . $review->users->last_name }}">
                                                    </figure>
                                                    <div class="review-right">
                                                        <span class="username"> {{ $review->users->first_name . ' ' . $review->users->last_name }}</span>&nbsp;<span
                                                                class="published">{{ $review->created_at->diffForHumans() }}</span>&nbsp;&nbsp;<span>@for($i=0;$i<$review->stars;$i++)
                                                                <span uk-icon="icon: star"></span>
                                                            @endfor stars</span>
                                                        <p>{{$review->review}}</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </article>
                                            @endforeach

                                            @if($product->reviews->where('status', 1)->count() > 3)
                                                <button class="btn show-more center"> show more</button>
                                            @endif
                                            <div class="clearfix"></div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" category mb">
        <div class="container-fluid">
            <div class="borders bg-white">
                <div class="category-title border_bottom">
                    <div class="category--title float-left">
                        <h5>Similar Products</h5>
                    </div>
                    <a href="{{ route('category', ['slug' => $product->categories->first()->slug]) }}"
                       class="float-right view-more">view more</a>
                    <div class="clearfix"></div>
                </div>
                <div class="product-category white-product">

                    <div class="owl-carousel categories">
                        @foreach($relatedProducts as $product)
                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
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
                                                <span class="Price-amount amount">
                                                        <span class="Price-currencySymbol">Rs</span>{{ number_format($product->sale_price) }}</span>
                                                <span class="Price-amount discount">
                                                    <span class="Price-currencySymbol">Rs</span>{{ number_format($product->product_price) }}
                                                </span>
                                                
                                            </span>
                                                <div class="save-upto">
                                                    @if($product->product_price>5)
                                                        @php
                                                            $discount = $product->product_price-$product->sale_price;
                                                            $discount_percentage = $discount/$product->product_price*100;
                                                        @endphp
                                                        <span class="product-label discount">-{{ number_format($discount_percentage)}}
                                                            %</span>
                                                    @endif
                                                </div>
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

    <section class=" category mb">
        <div class="container-fluid">
            <div class="borders bg-white">
                <div class="category-title border_bottom">
                    <div class="category--title float-left">
                        <h5>Recently Viewed</h5>
                    </div>
                    {{-- <a href="{{ route('category', ['slug' => $product->categories->first()->slug]) }}" class="float-right view-more">view more</a> --}}
                    <div class="clearfix"></div>
                </div>
                <div class="product-category white-product">

                    <div class="owl-carousel categories">
                        @foreach($recentlyViewedProducts as $product)
                            <article class="product instock sale purchasable">
                                <div class="product-wrap">
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
                                                <span class="Price-amount amount">
                                                        <span class="Price-currencySymbol">Rs</span>{{ number_format($product->sale_price) }}</span>
                                                <span class="Price-amount discount">
                                                    <span class="Price-currencySymbol">Rs</span>{{ number_format($product->product_price) }}
                                                </span>
                                                
                                            </span>
                                                <div class="save-upto">
                                                    @if($product->product_price>5)
                                                        @php
                                                            $discount = $product->product_price-$product->sale_price;
                                                            $discount_percentage = $discount/$product->product_price*100;
                                                        @endphp
                                                        <span class="product-label discount">-{{ number_format($discount_percentage)}}
                                                            %</span>
                                                    @endif
                                                </div>
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

    <div id="quickview-modal" class="product-description" uk-modal></div>

@endsection
@section('extra_scripts')
    <script>

        $(document).on("click", ".addtowishlist", function (e) {
            e.preventDefault();
            var $this = $(this);
            var product = $this.attr('data-product');

            if (product) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('wishlist.store')  }}",
                    data: {
                        product: product
                    },
                    beforeSend: function (data) {
                        $this.prop('disabled', true);
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.alert-message.alert-danger').fadeOut();

                            var message = '<div><span><strong><i class="fa fa-thumbs-o-up"></i>Success!</strong> ';
                            message += data.message;
                            message += '</span><a href="{{ route('home') }}" class="btn btn-xs btn-primary pull-right">View wishlist</a></div>';

                            $('.alert-message.alert-success').html(message).fadeIn().delay(3000).fadeOut('slow');

                            sweetAlert('success', 'Success', data.message + '<a href="{{ route('home') }}"> View Wishlist</a>');
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var err;
                        if (xhr.status === 401) {
                            err = eval("(" + xhr.responseText + ")");
                            sweetAlert('error', 'Oops...', err.message + '<a href="{{ route('login') }}"> Login</a>');
                            return false;
                        }

                        sweetAlert('error', 'Oops...', 'Something went wrong!');
                    },
                    complete: function () {
                        $this.prop('disabled', false);
                        //$("html, body").animate({scrollTop: 0}, "slow");
                    }
                });
            }

        });

        function UpdateMiniCart() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.mini')  }}",
                beforeSend: function (data) {
                    //
                },
                success: function (data) {
                    $('#update-cart').html(data);
                    $('#update-minicart').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //
                },
                complete: function () {
                    //
                }
            });
        }

        function sweetAlert(type, title, message) {
            swal({
                title: title,
                html: message,
                type: type,
                confirmButtonColor: '#ee3d43',
                timer: 3000
            }).catch(swal.noop);
        }

        // Add product to cart
        $(document).on("click", ".addtocart", function (e) {
            e.preventDefault();
            var $this = $(this);
            var product = $this.attr('data-product');
            var quantity = $('#quantity').val();
            quantity = quantity ? quantity : 1;
            // var select = document.getElementById("select_size");
            // if (select) {
            //     var size = select.options[select.selectedIndex].value;
            // }
            if (document.querySelector('input[name="size"]:checked')) {
                var size = document.querySelector('input[name="size"]:checked').value;
            }
            // if (document.querySelector('input[name="colour"]:checked')) {
            //     var colour = document.querySelector('input[name="colour"]:checked').value;
            // }
            // size = size ? size : 1;

            if (product) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.store')  }}",
                    data: {
                        product: product,
                        quantity: quantity,
                        size: size
                        // colour: colour
                    },
                    beforeSend: function (data) {
                        $this.button('loading');
                    },
                    success: function (data) {
                        if (data.status) {
                            $('.alert-message.alert-danger').fadeOut();

                            var message = '<div><span><strong><i class="fa fa-thumbs-o-up"></i>Success!</strong> ';
                            message += data.message;
                            message += '</span><a href="{{ route('cart') }}" class="btn btn-xs btn-primary pull-right">View cart</a></div>';

                            $('.alert-message.alert-success').html(message).fadeIn().delay(3000).fadeOut('slow');

                            sweetAlert('success', 'Success', data.message + '<a href="{{ route('cart') }}"> View Cart</a>');
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

        $(document).on("click", ".buynow", function (e) {
            e.preventDefault();
            var $this = $(this);
            var product = $this.attr('data-product');
            var quantity = $('#quantity').val();
            quantity = quantity ? quantity : 1;
            var select = document.getElementById("select_size");
            if (document.querySelector('input[name="size"]:checked')) {
                var size = document.querySelector('input[name="size"]:checked').value;
            }

            if (product) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.buy')  }}",
                    data: {
                        product: product,
                        quantity: quantity,
                        size: size
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
        (function ($) {
            $(document).ready(function () {
                $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 600, title: true, tint: '#333', Xoffset: 15});
                $('.xzoom2, .xzoom-gallery2').xzoom({position: '#xzoom2-id', tint: '#ffa200'});
                $('.xzoom3, .xzoom-gallery3').xzoom({
                    position: 'lens',
                    lensShape: 'circle',
                    sourceClass: 'xzoom-hidden'
                });
                $('.xzoom4, .xzoom-gallery4').xzoom({tint: '#006699', Xoffset: 15});
                $('.xzoom5, .xzoom-gallery5').xzoom({tint: '#006699', Xoffset: 15});

                //Integration with hammer.js
                var isTouchSupported = 'ontouchstart' in window;

                if (isTouchSupported) {
                    //If touch device
                    $('.xzoom, .xzoom2, .xzoom3, .xzoom4, .xzoom5').each(function () {
                        var xzoom = $(this).data('xzoom');
                        xzoom.eventunbind();
                    });

                    $('.xzoom, .xzoom2, .xzoom3').each(function () {
                        var xzoom = $(this).data('xzoom');
                        $(this).hammer().on("tap", function (event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            var s = 1, ls;

                            xzoom.eventmove = function (element) {
                                element.hammer().on('drag', function (event) {
                                    event.pageX = event.gesture.center.pageX;
                                    event.pageY = event.gesture.center.pageY;
                                    xzoom.movezoom(event);
                                    event.gesture.preventDefault();
                                });
                            }

                            xzoom.eventleave = function (element) {
                                element.hammer().on('tap', function (event) {
                                    xzoom.closezoom();
                                });
                            }
                            xzoom.openzoom(event);
                        });
                    });

                    $('.xzoom4').each(function () {
                        var xzoom = $(this).data('xzoom');
                        $(this).hammer().on("tap", function (event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            var s = 1, ls;

                            xzoom.eventmove = function (element) {
                                element.hammer().on('drag', function (event) {
                                    event.pageX = event.gesture.center.pageX;
                                    event.pageY = event.gesture.center.pageY;
                                    xzoom.movezoom(event);
                                    event.gesture.preventDefault();
                                });
                            }

                            var counter = 0;
                            xzoom.eventclick = function (element) {
                                element.hammer().on('tap', function () {
                                    counter++;
                                    if (counter == 1) setTimeout(openfancy, 300);
                                    event.gesture.preventDefault();
                                });
                            }

                            function openfancy() {
                                if (counter == 2) {
                                    xzoom.closezoom();
                                    $.fancybox.open(xzoom.gallery().cgallery);
                                } else {
                                    xzoom.closezoom();
                                }
                                counter = 0;
                            }

                            xzoom.openzoom(event);
                        });
                    });

                    $('.xzoom5').each(function () {
                        var xzoom = $(this).data('xzoom');
                        $(this).hammer().on("tap", function (event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            var s = 1, ls;

                            xzoom.eventmove = function (element) {
                                element.hammer().on('drag', function (event) {
                                    event.pageX = event.gesture.center.pageX;
                                    event.pageY = event.gesture.center.pageY;
                                    xzoom.movezoom(event);
                                    event.gesture.preventDefault();
                                });
                            }

                            var counter = 0;
                            xzoom.eventclick = function (element) {
                                element.hammer().on('tap', function () {
                                    counter++;
                                    if (counter == 1) setTimeout(openmagnific, 300);
                                    event.gesture.preventDefault();
                                });
                            }

                            function openmagnific() {
                                if (counter == 2) {
                                    xzoom.closezoom();
                                    var gallery = xzoom.gallery().cgallery;
                                    var i, images = new Array();
                                    for (i in gallery) {
                                        images[i] = {src: gallery[i]};
                                    }
                                    $.magnificPopup.open({items: images, type: 'image', gallery: {enabled: true}});
                                } else {
                                    xzoom.closezoom();
                                }
                                counter = 0;
                            }

                            xzoom.openzoom(event);
                        });
                    });

                } else {
                    //If not touch device

                    //Integration with fancybox plugin
                    $('#xzoom-fancy').bind('click', function (event) {
                        var xzoom = $(this).data('xzoom');
                        xzoom.closezoom();
                        $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
                        event.preventDefault();
                    });

                    //Integration with magnific popup plugin
                    $('#xzoom-magnific').bind('click', function (event) {
                        var xzoom = $(this).data('xzoom');
                        xzoom.closezoom();
                        var gallery = xzoom.gallery().cgallery;
                        var i, images = new Array();
                        for (i in gallery) {
                            images[i] = {src: gallery[i]};
                        }
                        $.magnificPopup.open({items: images, type: 'image', gallery: {enabled: true}});
                        event.preventDefault();
                    });
                }
            });
        })(jQuery);

    </script>

@endsection