@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')
    <div id="edit_address_shipping" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
    @if(Session('success'))
        <div class="notify">
            <div id="notif-messages" class="alert alert-success" style="display: block;">
                <span class="icon-circle-check mr-2"></span>
                <button type="button" class="close">×</button>
                {{ Session('success') }}
            </div>
        </div>
    @endif
    @if(Session('error'))
        <div class="notify">
            <div id="notif-messages" class="alert alert-error" style="display: block;">
                <span class="icon-circle-check mr-2"></span>
                <button type="button" class="close">×</button>
                {{ Session('error') }}
            </div>
        </div>
    @endif

    <section class="singlepage-container services-singlepage">
        <section class="singlepage-information">
            <div class="container-fluid uk-margin-bottom">

                <div class="servicedetails">
                    <div class="servicedetails_header">
                        <div class="largeImageBanner" uk-parallax="bgy: -200"
                             style="background: url({{ $service->getImage()->url }}) calc(0px) / 1214px 805px no-repeat">
                            <div class="servicedetails--abs clearfix">
                                <span class="servicedetails--name pull-left">{{ $service->name }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="miniBlpage">
                                <div class="aboutSection">
                                    <h3>About {{ $service->name }}</h3>
                                    <div>
                                        <p>
                                            <span style="color: rgb(97, 97, 97); font-size: 16px;">            {!! $service->description !!}</span><br>
                                        </p>
                                        <p id="aboutCompanyContent">Services in <a
                                                    href="{{ route('service.link', ['slug' => $service->serviceCategory->slug]) }}">{{ $service->serviceCategory->name }}</a><br>
                                        </p>
                                        <div class="text-right"></div>
                                    </div>
                                </div>
                                <div class="aboutSection" id="aboutSection">
                                    <h3>Service Details (Within City)</h3>
                                    <div class="provider clearfix" id="cities">
                                        <ul class="liststyle--none">
                                            @foreach(  $service->locations as $location )
                                                <li class="active"><a>{{ $location->location }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="serviceDetailFilter">
                                <form class="serviceDetailfilterForm" method="post"
                                      action="{{route('service.request')}}">
                                    {{ csrf_field() }}
                                    <div class="serviceDetailfilterInnerarea" id="serviceone">
                                        <div class="titleFilter-header">
                                            <h4>Filters</h4>

                                        </div>
                                        @if(isset($shipping))
                                            <input type="hidden" name="address_id" value="{{ $shipping->id }}">
                                        @endif
                                        <input type="hidden" name="service" value="{{ $service->id }}">
                                        <div class="uk-margin serviceSelect">
                                            <span class="types">When do you need the Service?</span>
                                            <select class="uk-select typeService" name="time">
                                                @foreach($service->times as $time)
                                                    <option value="{{ $time->id }}">{{ $time->time }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="uk-margin serviceSelect">
                                            <span class="types">Select Your City</span>
                                            <select class="uk-select typeService" name="location">
                                                @foreach($service->locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="uk-margin serviceSelect">
                                            <span class="types">Remarks</span>
                                            <textarea class="typeService uk-textarea" rows="7"
                                                      name="description"></textarea>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="serviceEnquiryButton nextservice">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    {{--second form--}}
                                    <div class="serviceDetailfilterInnerarea" id="servicetwo" style="display: none;">
                                        @if(Auth::check())
                                            <div class="box-shadow uk-margin-bottom">
                                                <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;position: relative">
                                                    Request Info
                                                    @if(isset($shipping))
                                                        <a class="pull-right link btn-edit"
                                                           data-edit-id="{{$shipping->id }}" uk-icon="icon: pencil"
                                                           title="edit" data-target="#edit_address_shipping"
                                                           data-toggle="modal">
                                                        </a>
                                                    @endif
                                                </h4>
                                                @if(isset($shipping))
                                                    <div class="uk-margin">
                                                        <div class="uk-form-stacked uk-padding-small">
                                                            <div class="row" style=" margin:0 -15px;">
                                                                <div class="col-sm-6">
                                                                    <div class="uk-margin">
                                                                        <label class="uk-form-label"
                                                                               for="form-stacked-text">First
                                                                            Name</label>
                                                                        <div class="uk-form-controls">
                                                                            <input class="uk-input"
                                                                                   id="form-stacked-text" type="text"
                                                                                   placeholder="first name"
                                                                                   name="first_name"
                                                                                   value="{{ isset($shipping->first_name)?$shipping->first_name:'' }}">
                                                                        </div>
                                                                        @if ($errors->has('first_name'))
                                                                            <span class="help-block">
                                                    {{ $errors->first('first_name') }}
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="uk-margin">
                                                                        <label class="uk-form-label"
                                                                               for="form-stacked-text">Last
                                                                            Name</label>
                                                                        <div class="uk-form-controls">
                                                                            <input class="uk-input"
                                                                                   id="form-stacked-text" type="text"
                                                                                   placeholder="last name"
                                                                                   name="last_name"
                                                                                   value="{{ isset($shipping->last_name)?$shipping->last_name:'' }}">
                                                                        </div>
                                                                        @if ($errors->has('last_name'))
                                                                            <span class="help-block">
                                                    {{ $errors->first('last_name') }}
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="uk-margin">
                                                                <label class="uk-form-label" for="form-stacked-text">Street
                                                                    Name</label>
                                                                <div class="uk-form-controls">
                                                                    <input class="uk-input" id="form-stacked-text"
                                                                           type="text"
                                                                           placeholder="postcode" name="street_name"
                                                                           value="{{ isset($shipping->street_name)?$shipping->street_name:'' }}">
                                                                </div>
                                                                @if ($errors->has('street_name'))
                                                                    <span class="help-block">
                                                    {{ $errors->first('street_name') }}
                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="uk-margin">
                                                                <label class="uk-form-label"
                                                                       for="form-stacked-text">Landmark</label>
                                                                <div class="uk-form-controls">
                                                                    <input class="uk-input" id="form-stacked-text"
                                                                           type="text"
                                                                           placeholder="postcode" name="landmark"
                                                                           value="{{ isset($shipping->landmark)?$shipping->landmark:'' }}">
                                                                </div>
                                                                @if ($errors->has('landmark'))
                                                                    <span class="help-block">
                                                    {{ $errors->first('landmark') }}
                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="uk-margin">
                                                                <label class="uk-form-label"
                                                                       for="form-stacked-text">Mobile</label>
                                                                <div class="uk-form-controls">
                                                                    <input class="uk-input" id="form-stacked-text"
                                                                           type="text"
                                                                           placeholder="postcode" name="mobile"
                                                                           value="{{ isset($shipping->mobile)?$shipping->mobile:'' }}">
                                                                </div>
                                                                @if ($errors->has('mobile'))
                                                                    <span class="help-block">
                                                    {{ $errors->first('mobile') }}
                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <button type="button"
                                                                            class="serviceEnquiryButton servicereturn">
                                                                        <span uk-icon="icon: chevron-left"></span>Back
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <button type="submit" class="serviceEnquiryButton">
                                                                        Confirm
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <center>
                                                        <a style="display: inline-block;margin-top: 60px;"
                                                           href="{{ route('user.account') }}"
                                                           class="serviceEnquiryButton nextservice">
                                                            Plz Add Or Select Shipping Address
                                                        </a>
                                                    </center>
                                                @endif
                                            </div>

                                        @else
                                            <center>
                                                <a style="display: inline-block;margin-top: 60px;"
                                                   href="{{ route('user.account') }}"
                                                   class="serviceEnquiryButton nextservice">
                                                    Loging To you Account
                                                </a>
                                            </center>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="container comment-container">--}}
                {{--<span class="comment-header">User Reviews</span>--}}

                {{--<!-- product review -->--}}
                {{--<div id="product__review ">--}}
                    {{--<div class="box-shadow mb p-4" style=" background: white;">--}}
                        {{--<div class="product__review__name heading">--}}
                            {{--<h3>--}}
                                {{--Reviews of G Stylo MS631 16GB 4G LTE SmartPhone GSM Unlocked--}}
                            {{--</h3>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        {{--<div class="" style="padding: 10px 0px;">--}}
                            {{--<span class="review--heading">Customer review</span>--}}
                            {{--<fieldset class="rating">--}}
                                {{--<input type="radio" id="star5" name="rating" value="5"/><label class="full"--}}
                                                                                               {{--for="star5"--}}
                                                                                               {{--title="Awesome - 5 stars"></label>--}}
                                {{--<input type="radio" id="star4" name="rating" value="4"/><label class="full"--}}
                                                                                               {{--for="star4"--}}
                                                                                               {{--title="Pretty good - 4 stars"></label>--}}

                                {{--<input type="radio" id="star3" name="rating" value="3"/><label class="full"--}}
                                                                                               {{--for="star3"--}}
                                                                                               {{--title="Meh - 3 stars"></label>--}}

                                {{--<input type="radio" id="star2" name="rating" value="2"/><label class="full"--}}
                                                                                               {{--for="star2"--}}
                                                                                               {{--title="Kinda bad - 2 stars"></label>--}}

                                {{--<input type="radio" id="star1" name="rating" value="1"/><label class="full"--}}
                                                                                               {{--for="star1"--}}
                                                                                               {{--title="Sucks big time - 1 star"></label>--}}

                            {{--</fieldset>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                        {{--<form action="" method="post" class="review-form">--}}

                            {{--<p class="comment">write something</p>--}}
                            {{--<textarea type="text" class="form-control" id="comment"--}}
                                      {{--placeholder="write something"--}}
                                      {{--rows="3" cols="100">--}}

                    {{--</textarea>--}}
                            {{--<a class="btn btn-info " href=""> comment</a>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</form>--}}
                        {{--<div class="clearfix"></div>--}}
                        {{--<p class="review-user">4.1 average based on 254 reviews.</p>--}}
                        {{--<hr style="border:3px solid #f1f1f1; width:70%">--}}
                        {{--<div class="row review-rating">--}}
                            {{--<div class="side">--}}
                                {{--<div>5 star</div>--}}
                            {{--</div>--}}
                            {{--<div class="middle">--}}
                                {{--<div class="bar-container">--}}
                                    {{--<div class="bar-5"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="side right">--}}
                                {{--<div>150</div>--}}
                            {{--</div>--}}
                            {{--<div class="side">--}}
                                {{--<div>4 star</div>--}}
                            {{--</div>--}}
                            {{--<div class="middle">--}}
                                {{--<div class="bar-container">--}}
                                    {{--<div class="bar-4"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="side right">--}}
                                {{--<div>63</div>--}}
                            {{--</div>--}}
                            {{--<div class="side">--}}
                                {{--<div>3 star</div>--}}
                            {{--</div>--}}
                            {{--<div class="middle">--}}
                                {{--<div class="bar-container">--}}
                                    {{--<div class="bar-3"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="side right">--}}
                                {{--<div>15</div>--}}
                            {{--</div>--}}
                            {{--<div class="side">--}}
                                {{--<div>2 star</div>--}}
                            {{--</div>--}}
                            {{--<div class="middle">--}}
                                {{--<div class="bar-container">--}}
                                    {{--<div class="bar-2"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="side right">--}}
                                {{--<div>6</div>--}}
                            {{--</div>--}}
                            {{--<div class="side">--}}
                                {{--<div>1 star</div>--}}
                            {{--</div>--}}
                            {{--<div class="middle">--}}
                                {{--<div class="bar-container">--}}
                                    {{--<div class="bar-1"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="side right">--}}
                                {{--<div>20</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="review-container">--}}
                            {{--<h3 class="review-title">Reviews</h3>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}
                            {{--<article class="reviews">--}}
                                {{--<figure class="user-image">--}}
                                    {{--<img src="https://yt3.ggpht.com/-lASduCKYbGI/AAAAAAAAAAI/AAAAAAAAAAA/bCSffOUUASk/s48-c-k-no-mo-rj-c0xffffff/photo.jpg"--}}
                                         {{--alt="">--}}
                                {{--</figure>--}}
                                {{--<div class="review-right">--}}
                                    {{--<span class="username"> Jhon Deo</span>&nbsp;<span--}}
                                            {{--class="published">2018/2/9</span>&nbsp;&nbsp;<span>stars</span>--}}
                                    {{--<p>lorem ipsum sumet is the inlu one that is very popular in webs--}}
                                        {{--designing to--}}
                                        {{--place--}}
                                        {{--a dumy text</p>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix"></div>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</article>--}}

                            {{--<button class="button-primary-outline show-more center"> show more</button>--}}
                            {{--<div class="clearfix"></div>--}}

                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
            <hr>
            <!--related products-->
            <div class="product-category white-product services-category">
                <div class="my-container">
                    <h3 style="text-align: left" class="title">Recent Added Services
                    </h3>
                    <div class="owl-carousel product-carousel inner-column owl-loaded owl-drag">


                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                 style="transform: translate3d(-1097px, 0px, 0px); transition: all 0s ease 0s; width: 3659px;">
                                @foreach($services as $service)
                                    @if(isset($service->getImage()->smallUrl))
                                <div class="owl-item cloned" style="width: 177.945px; margin-right: 5px;">
                                    <article
                                            class="product type-product status-publish  instock sale shipping-taxable purchasable product-type-simple "
                                    >
                                        <div class="product-wrap">
                                            <div class="product-top">

                                                <figure>
                                                    <a href="{{ route('service.show', ['slug' => $service->slug]) }}">
                                                        <div class="product-image">
                                                            <img width="320" height="320"
                                                                 src="{{ $service->getImage()->smallUrl }}"
                                                                 class="attachment-shop_catalog size-shop_catalog" alt="">
                                                        </div>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="product-meta">
                                                <div class="title-wrap">
                                                    <h3 class="product-title">
                                                        <a href="{{ route('service.show', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                                                    </h3>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev"><i
                                        class="fa fa-chevron-left fa-1x"></i></button>
                            <button type="button" role="presentation" class="owl-next"><i
                                        class="fa fa-chevron-right fa-1x"></i></button>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </section>

@endsection

@push('scripts')

    <script>
        var $modal = $('#edit_address_shipping');
        $(document).on("click", ".btn-edit", function (e) {
            e.preventDefault();
            var $this = $(this);
            var id = $this.attr('data-edit-id');
            var tempEditUrl = "{{ route('my-account.shipping.edit', ':id') }}";
            tempEditUrl = tempEditUrl.replace(':id', id);

            $modal.load(tempEditUrl, function (response) {
                $modal.modal({show: true});

            });
        });
    </script>

@endpush