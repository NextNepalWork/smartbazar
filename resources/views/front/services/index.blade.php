@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')
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
    <div id="slide-banner">
        <div id="sliding_banner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#sliding_banner" data-slide-to="0" class="active"></li>
                <li data-target="#sliding_banner" data-slide-to="1"></li>

            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                @foreach($slideshows as $slideshow)
                    <div class="carousel-item active">
                        <a href="#"> <img src="{{ url('/').$slideshow->image }}" alt=""></a>

                    </div>
            @endforeach
            <!-- Slide Two - Set the background image for this slide in the line below -->


            </div>

        </div>
    </div>
    <div class="bg-fixed"
         style="background-image: url({{asset('images/background/bg.png')}}); background-attachment: fixed; background-position: center;background-repeat: no-repeat;background-size: cover;">
        <div class="container-fluid">


            <section class="services-grid bg-white px-2 mb">
                <div class="my-container">
                    <h3 style="text-align: left;margin-bottom:0;" class="title">Assured Services at Your Doorstep
                        <span class="sub-title">Verified Professional | Standard Pricing | On Time Delivery</span>
                    </h3>
                </div>
                <div class="cat-grid d-flex align-items-center justify-content-center flex-wrap my-container py-3 ">
                    @foreach( $serviceCategories as $serviceCategory )
                        @if(isset($serviceCategory->getImage()->smallUrl))
                            <figure class="brand-cat">
                                <a href="{{ route('service.link', ['slug' => $serviceCategory->slug]) }}">
                                    <img width="100" height="100" src="{{ $serviceCategory->getImage()->smallUrl }}" class="attachment-100x100 size-100x100" alt="">
                                    <div class="brand-meta">{{ $serviceCategory->name }}</div>
                                </a>
                            </figure>
                        @endif
                    @endforeach
                </div>
            </section>
            {{--<section class="section-collection">--}}
                {{--<div class="container-fluid">--}}
                    {{--<div class="d-flex section-collection-tittle topic-title justify-content-between">--}}
                        {{--<div class="heading">--}}
                            {{--<h3 class="text-white">Collection</h3>--}}
                        {{--</div>--}}
                        {{--<a href="collectionpage.html" class="view-more"> view more <span uk-icon="forward"></span></a>--}}
                    {{--</div>--}}
                    {{--<div class="row    ">--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-2.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-1.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-7.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-8.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-4 col-6.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-5.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-4.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class=" col-lg-3 col-md-4 col-sm-4 col-6">--}}
                            {{--<div class="collections-item">--}}
                                {{--<a class="collections-link" href="category-page.html">--}}
                                    {{--<div class="collections-product">--}}
                                        {{--<figure>--}}
                                            {{--<img src="images/collection-3.jpg"--}}
                                                 {{--alt="">--}}
                                        {{--</figure>--}}
                                    {{--</div>--}}
                                    {{--<div class="collections-title">Upgrade Your Lifestyle &gt;</div>--}}
                                    {{--<div class="collections-subtitle"--}}
                                    {{-->--}}
                                        {{--3,721 products--}}
                                    {{--</div>--}}


                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}
            {{--<div class="section_front-cat">--}}
                {{--<div class="container-fluid">--}}
                    {{--<div class=" row front-cat_title topic-title d-flex justify-content-between">--}}
                        {{--<div class="heading">--}}
                            {{--<h3 class="text-white">categories</h3>--}}
                        {{--</div>--}}
                        {{--<a href="#" class="view-more"> view more <span uk-icon="forward"></span></a>--}}
                    {{--</div>--}}
                    {{--<div class=" row  justify-content-between d-flex front-cat_details">--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/card-4.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>t-shirt</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/collection-3.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Women fashoin</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/card-1.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>electronics and devices</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/card-3.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Home Appliances</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/collection-8.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Sound and Speaker</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/collection-2.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Home Applainces</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/collection-1.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Shoes and Socks</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cat-detail">--}}
                            {{--<div class="cat-img">--}}
                                {{--<img src="images/card-2.jpg" alt="">--}}
                            {{--</div>--}}
                            {{--<div class="cat-name">--}}
                                {{--<h3>Kids and Baby</h3>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="dummy"></div>--}}
                        {{--<div class="dummy"></div>--}}
                        {{--<div class="dummy"></div>--}}
                        {{--<div class="dummy"></div>--}}
                        {{--<div class="dummy"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
            <div class="services-category mb">
                <div class="my-container bg-white">
                    <div class="px-2">
                        <h3 style="text-align: left" class="title ">Popular Services
                            <span class="sub-title"></span>
                        </h3>
                    </div>
                    <div class="product-category white-product">
                        <div class="owl-carousel product-carousel  inner-column ">
                            @foreach( $services as $service )

                                @if(isset($service->getImage()->smallUrl))
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
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
            <section class="customer-service ">
                <div class="my-container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="cs_content">
                                <figure>
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>
                                            <g>
                                                <path d="M256,40.01c-5.538,0-9.99,4.46-9.99,9.99c0,5.147,3.872,9.43,8.99,9.938c5.925,0.588,10.99-4.027,10.99-9.938
			C265.99,44.462,261.53,40.01,256,40.01z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M456,60c-27.57,0-50-22.43-50-50c0-5.522-4.478-10-10-10H116c-5.522,0-10,4.478-10,10c0,27.57-22.43,50-50,50
			c-5.522,0-10,4.478-10,10v163.19c0,127.177,82.895,241.135,207.128,278.389c0.937,0.28,1.904,0.421,2.872,0.421
			c0.968,0,1.937-0.141,2.873-0.422C380.415,475.119,466,363.149,466,233.19V70C466,64.478,461.522,60,456,60z M446,233.19
			c0,119.448-76.221,222.892-190,258.353C143.128,456.365,66,351.984,66,233.19V79.288C96.611,74.89,120.89,50.611,125.288,20
			h261.424C391.11,50.611,415.389,74.89,446,79.288V233.19z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M420.012,92.49c-20.854-9.133-37.369-25.648-46.502-46.502C371.916,42.35,368.322,40,364.35,40h-68.37
			c-5.522,0-10,4.478-10,10s4.478,10,10,10h62.047c10.565,20.681,27.292,37.407,47.973,47.973V233.19
			c0,97.863-58.749,182.303-150,216.104c-91.251-33.802-150-118.241-150-216.104V107.973C126.681,97.407,143.407,80.681,153.973,60
			h62.047c5.522,0,10-4.478,10-10s-4.478-10-10-10h-68.37c-3.972,0-7.566,2.351-9.16,5.988
			c-9.133,20.854-25.648,37.369-46.502,46.502C88.351,94.084,86,97.679,86,101.65v131.54c0,107.213,66.311,200.653,166.664,236.166
			c1.079,0.382,2.207,0.573,3.336,0.573c1.129,0,2.257-0.191,3.336-0.573C359.605,433.873,426,340.49,426,233.19V101.65
			C426,97.678,423.649,94.084,420.012,92.49z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,146c-49.626,0-90,40.374-90,90c0,49.626,40.374,90,90,90c49.626,0,90-40.374,90-90C346,186.374,305.626,146,256,146z
			 M256,306c-38.598,0-70-31.402-70-70c0-38.598,31.402-70,70-70c38.598,0,70,31.402,70,70C326,274.598,294.598,306,256,306z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M303.071,208.928c-3.906-3.904-10.236-3.904-14.143,0L246,251.857l-12.929-12.928c-3.906-3.904-10.236-3.904-14.143,0
			c-3.905,3.905-3.905,10.237,0,14.143l20,20C240.882,275.023,243.44,276,246,276s5.118-0.977,7.071-2.929l50-50
			C306.976,219.166,306.976,212.834,303.071,208.928z"></path>
                                            </g>
                                        </g>
                            </svg>

                                </figure>
                                <div class="cs_servicename">
                                    guarentee
                                </div>
                                <div class="cs_description">
                                    That a reader will be distracted by the readable content of a page when looking at
                                    its layout.
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cs_content">
                                <figure>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 511.999 511.999"
                                         style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve"><g>
                                            <g>
                                                <path d="M509.07,194.061L414.3,99.29c-3.906-3.905-10.24-3.906-14.148,0c-3.906,3.906-3.906,10.24,0,14.148l87.697,87.696
			l-51.274,51.273c-1.571,1.57-4.126,1.57-5.695,0l-101.25-101.249c-1.571-1.57-1.571-4.125,0-5.696l34.411-34.413
			c3.906-3.906,3.906-10.24,0-14.147c-3.907-3.906-10.239-3.906-14.148,0l-34.411,34.411c-7.128,7.129-8.818,17.655-5.1,26.412
			l-11.638,11.638h-44.877h-3.537h-32.955l-14.682-14.682c0.564-2.058,0.862-4.201,0.862-6.392c0-6.42-2.501-12.456-7.04-16.995
			l-33.481-33.481c-3.907-3.906-10.239-3.906-14.148,0c-3.906,3.906-3.906,10.24,0,14.148l33.482,33.481
			c1.026,1.026,1.18,2.225,1.18,2.847s-0.153,1.821-1.181,2.848l-2.786,2.786l-98.495,98.471c-0.032,0.032-0.059,0.067-0.09,0.099
			c-0.998,0.923-2.128,1.073-2.727,1.073c-0.623,0-1.822-0.153-2.848-1.179L24.15,201.114l88.876-88.875
			c3.906-3.906,3.906-10.24,0-14.147s-10.238-3.906-14.148,0L2.93,194.041c-3.906,3.906-3.906,10.24,0,14.147l58.346,58.347
			c4.687,4.686,10.841,7.028,16.995,7.028c2.826,0,5.646-0.518,8.329-1.507l32.843,32.843c-2.55,4.784-4,10.237-4,16.025
			c0,18.853,15.338,34.191,34.191,34.191c0.042,0,0.084-0.003,0.126-0.003c0,0.002,0,0.004,0,0.006
			c0,18.811,15.269,34.119,34.064,34.188c0,0.015-0.001,0.029-0.001,0.044c0,18.853,15.338,34.191,34.191,34.191
			c5.8,0,11.265-1.456,16.055-4.015l12.227,12.227c5.732,5.732,13.354,8.889,21.46,8.889c8.107,0,15.729-3.157,21.46-8.889
			c5.427-5.427,8.546-12.548,8.862-20.171c7.393-0.368,14.678-3.368,20.311-9.002c5.952-5.952,9.166-13.866,9.051-22.282
			c0-0.018-0.001-0.035-0.001-0.053c8.703-0.54,16.71-4.354,22.63-10.805c5.951-6.482,8.896-14.656,8.87-22.81
			c8.37-0.241,16.201-3.613,22.146-9.559c6.202-6.201,9.603-14.447,9.573-23.218c-0.017-5.164-1.229-10.132-3.49-14.608l32.81-30
			c4.115,2.876,8.927,4.335,13.749,4.335c6.154,0,12.309-2.343,16.995-7.027l58.346-58.347
			C512.976,204.301,512.976,197.967,509.07,194.061z M149.635,335.11c-7.822,0-14.185-6.363-14.185-14.185
			c0-7.821,6.363-14.184,14.185-14.184c7.822,0,14.185,6.363,14.185,14.184C163.819,328.747,157.456,335.11,149.635,335.11z
			 M194.516,364.551c-0.407,0.386-0.804,0.781-1.192,1.186c-2.503,2.212-5.779,3.567-9.373,3.567
			c-7.821,0-14.184-6.363-14.184-14.185s6.362-14.185,14.184-14.185s14.185,6.363,14.185,14.185
			C198.135,358.743,196.758,362.042,194.516,364.551z M228.18,399.225c-0.046,0.044-0.095,0.082-0.14,0.127
			c-0.05,0.05-0.091,0.104-0.139,0.154c-2.557,2.491-6.043,4.032-9.885,4.032c-7.823-0.002-14.186-6.365-14.186-14.186
			c0-3.623,1.376-6.922,3.619-9.431c0.407-0.386,0.804-0.781,1.192-1.186c2.502-2.212,5.779-3.566,9.373-3.566
			c7.821,0,14.185,6.363,14.185,14.185C232.199,393.19,230.663,396.669,228.18,399.225z M366.94,322.927
			c-2.395,2.394-5.577,3.712-8.963,3.712s-6.568-1.318-8.963-3.711l-20.782-20.783c-3.906-3.906-10.238-3.906-14.148,0
			c-3.906,3.906-3.906,10.24,0,14.147l20.781,20.782c0.001,0,0.002,0.001,0.002,0.001l0.063,0.063
			c5.157,5.156,5.333,13.402,0.401,18.774c-2.478,2.7-5.859,4.257-9.522,4.385c-3.655,0.135-7.145-1.188-9.805-3.707l-20.011-18.942
			c-4.013-3.798-10.344-3.625-14.142,0.388c-3.798,4.012-3.625,10.343,0.387,14.142l21.787,20.625
			c2.157,2.042,3.367,4.802,3.408,7.772c0.041,2.97-1.093,5.762-3.193,7.862c-4.251,4.253-11.173,4.252-15.424,0l-10.101-10.101
			c-3.907-3.906-10.239-3.906-14.148,0c-1.953,1.954-2.93,4.513-2.93,7.073s0.977,5.121,2.93,7.073l10.5,10.5
			c1.954,1.954,3.03,4.551,3.03,7.313s-1.076,5.36-3.03,7.313c-1.954,1.954-4.551,3.029-7.313,3.029
			c-2.763,0-5.359-1.076-7.313-3.03l-12.235-12.235c2.548-4.782,3.997-10.233,3.997-16.019c0-18.811-15.27-34.119-34.065-34.188
			c0-0.015,0.001-0.029,0.001-0.044c0-18.853-15.338-34.191-34.191-34.191c-0.042,0-0.083,0.003-0.125,0.003
			c0-0.002,0-0.004,0-0.006c0-18.853-15.338-34.19-34.191-34.19c-5.798,0-11.261,1.455-16.049,4.012l-31.265-31.264l88.44-88.441
			l15.399,15.4c1.877,1.876,4.421,2.93,7.073,2.93h12.948l-39.486,39.486c-6.037,6.037-9.361,14.065-9.361,22.603
			c0,8.538,3.324,16.565,9.361,22.602c6.037,6.038,14.065,9.362,22.603,9.362s16.566-3.325,22.603-9.362l33.491-33.492l36.665,0.402
			l64.825,63.967c2.422,2.39,3.762,5.58,3.772,8.982C370.665,317.322,369.346,320.52,366.94,322.927z M374.169,284.024
			l-60.938-60.131c-0.001-0.001-0.002-0.002-0.003-0.003l-0.088-0.087c-2.25-2.221-5.287-3.151-8.201-2.808l-43.539-0.477
			c-2.7-0.02-5.28,1.027-7.183,2.929l-36.467,36.468c-2.259,2.259-5.262,3.502-8.455,3.502s-6.196-1.243-8.455-3.502
			c-2.259-2.258-3.502-5.261-3.502-8.455c0-3.194,1.243-6.197,3.502-8.456l53.633-53.633h48.416c2.653,0,5.197-1.054,7.073-2.93
			l13.328-13.328l82.237,82.237L374.169,284.024z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <circle cx="438.336" cy="205.74" r="9.983"></circle>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <circle cx="72.644" cy="206.74" r="9.983"></circle>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <circle cx="131.064" cy="82.139" r="9.983"></circle>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <circle cx="380.757" cy="81.338" r="9.983"></circle>
                                            </g>
                                        </g>
                            </svg>

                                </figure>
                                <div class="cs_servicename">
                                    our Trust
                                </div>
                                <div class="cs_description">
                                    That a reader will be distracted by the readable content of a page when looking at
                                    its layout.
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cs_content">
                                <figure>

                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512.002 512.002"
                                         style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve"><g>
                                            <g>
                                                <g>
                                                    <path d="M128.497,336.827c-4.499-3.802-11.228-3.237-15.033,1.262c-1.468,1.738-2.921,3.52-4.317,5.299
				c-3.638,4.634-2.831,11.339,1.803,14.976c1.953,1.535,4.275,2.277,6.579,2.277c3.163,0,6.292-1.401,8.397-4.08
				c1.238-1.578,2.528-3.159,3.831-4.701C133.56,347.36,132.996,340.63,128.497,336.827z"></path>
                                                    <path d="M325.299,127.788c2.023,1.769,4.524,2.636,7.016,2.636c2.971,0,5.928-1.234,8.035-3.647
				c1.469-1.68,2.811-3.362,3.99-5.001c3.442-4.78,2.359-11.446-2.421-14.89c-4.782-3.443-11.448-2.358-14.89,2.421
				c-0.79,1.098-1.714,2.251-2.742,3.429C320.41,117.174,320.864,123.912,325.299,127.788z"></path>
                                                    <path d="M501.334,447.995H485.08c-1.812-39.245-13.6-77.268-34.378-110.568c-20.219-32.404-48.171-59.207-81.219-78.058
				c1.372-3.602,2.658-7.61,3.891-12.111h21.99c20.007,0,36.283-16.277,36.283-36.284v-33.613c0-20.006-16.276-36.283-36.283-36.283
				h-3.785c0.926-14.488,0.416-28.445-2.935-39.659c-9.25-30.97-26.802-56.812-50.762-74.733C314.543,9.229,286.228,0.001,256.001,0
				c-30.226,0-58.541,9.228-81.883,26.688c-23.957,17.921-41.512,43.761-50.764,74.732c-3.35,11.214-3.859,25.171-2.933,39.66
				h-3.782c-20.007,0-36.283,16.276-36.283,36.283v33.613c0,20.007,16.276,36.284,36.283,36.284h21.988
				c1.233,4.502,2.52,8.509,3.89,12.111c-33.046,18.85-60.999,45.653-81.218,78.059c-20.778,33.302-32.564,71.322-34.378,110.567
				H10.669c-5.891,0-10.667,4.777-10.667,10.667s4.776,10.667,10.667,10.667h26.667h69.929l10.52,35.067
				c1.354,4.511,5.506,7.601,10.217,7.601h209.926c0.017,0,0.032,0.003,0.048,0.003c0.025,0,0.05-0.003,0.075-0.003H384
				c4.71,0,8.864-3.09,10.217-7.601l10.52-35.067h69.93h26.667c5.891,0,10.667-4.777,10.667-10.667
				C512.001,452.772,507.226,447.995,501.334,447.995z M380.768,211.324c0.56-3.404,1.405-7.806,2.382-12.904
				c2.017-10.512,4.419-23.041,6.211-36.007h6.004v-0.001c8.243,0,14.949,6.706,14.949,14.949v33.613
				c0,8.244-6.706,14.951-14.949,14.951H378.19C379.05,221.419,379.904,216.571,380.768,211.324z M116.639,225.924v0.001
				c-8.243,0-14.949-6.706-14.949-14.951v-33.613c0-8.243,6.706-14.949,14.949-14.949h6.002c1.792,12.959,4.193,25.485,6.208,35.992
				c0.978,5.103,1.824,9.51,2.384,12.918c0.864,5.248,1.719,10.096,2.578,14.602H116.639z M141.719,139.762
				c-0.807-12.25-0.47-23.712,2.077-32.236c15.883-53.165,58.876-86.193,112.204-86.193c53.332,0.002,96.326,33.03,112.203,86.194
				c3.194,10.688,2.919,25.987,1.264,41.675c-0.201,0.817-0.318,1.666-0.318,2.544c0,0.077,0.011,0.153,0.012,0.228
				c-1.764,15.31-4.723,30.751-6.962,42.426c-1.006,5.245-1.875,9.775-2.481,13.457c-1.487,9.032-2.882,16.655-4.285,23.172
				c-15.733,14.299-42.51,24.087-69.696,26.406c-0.771-5.134-5.187-9.074-10.536-9.074H256c-5.89,0-10.667,4.777-10.667,10.667
				v8.533c0,0.115,0.014,0.227,0.018,0.34c0.006,0.213,0.013,0.427,0.031,0.638c0.014,0.148,0.036,0.292,0.057,0.439
				c0.027,0.203,0.054,0.405,0.092,0.604c0.031,0.159,0.07,0.316,0.109,0.473c0.044,0.178,0.085,0.356,0.138,0.532
				c0.05,0.171,0.109,0.336,0.169,0.503c0.054,0.156,0.108,0.314,0.171,0.467c0.068,0.173,0.148,0.34,0.227,0.51
				c0.067,0.142,0.131,0.285,0.203,0.422c0.086,0.165,0.182,0.327,0.277,0.487c0.08,0.134,0.158,0.27,0.243,0.401
				c0.1,0.151,0.206,0.298,0.313,0.444c0.096,0.132,0.192,0.264,0.293,0.393c0.107,0.133,0.219,0.26,0.332,0.387
				c0.115,0.131,0.231,0.262,0.353,0.388c0.11,0.114,0.226,0.222,0.341,0.331c0.135,0.128,0.271,0.255,0.413,0.375
				c0.115,0.098,0.237,0.19,0.355,0.284c0.153,0.117,0.303,0.235,0.461,0.344c0.125,0.086,0.254,0.166,0.383,0.247
				c0.16,0.102,0.321,0.204,0.487,0.295c0.141,0.079,0.286,0.151,0.431,0.223c0.16,0.081,0.321,0.162,0.487,0.236
				c0.164,0.071,0.334,0.135,0.505,0.201c0.153,0.058,0.304,0.117,0.462,0.169c0.191,0.063,0.385,0.113,0.58,0.165
				c0.146,0.038,0.289,0.079,0.437,0.112c0.204,0.045,0.413,0.077,0.621,0.111c0.115,0.018,0.225,0.046,0.34,0.061
				c0.067,0.008,0.135,0.014,0.203,0.021c0.027,0.003,0.052,0.006,0.079,0.01c6.076,0.756,12.273,1.126,18.514,1.126
				c24.068,0,48.73-5.447,69.066-14.911c-5.082,6.342-11.688,10.548-21.194,16.594c-3.97,2.525-8.46,5.38-13.457,8.762
				c-17.228,9.885-34.68,14.895-51.877,14.895c-17.194,0-34.643-5.009-51.866-14.889c-4.997-3.381-9.486-6.237-13.456-8.763
				c-18.938-12.047-26.379-16.781-33.147-45.683c-0.09-0.743-0.256-1.462-0.492-2.153c-1.561-6.966-3.1-15.265-4.751-25.295
				c-0.606-3.685-1.476-8.221-2.483-13.472c-1.796-9.372-4.059-21.174-5.794-33.385c19.584-2.734,61.573-9.824,89.863-23.396
				l7.005,16.807c0.716,1.719,1.309,3.231,1.826,4.549c2.357,6,4.583,11.667,11.252,13.915c1.598,0.539,3.134,0.778,4.705,0.777
				c3.73,0,7.665-1.344,13.119-3.206c1.499-0.513,3.189-1.09,5.097-1.719c7.397-2.439,22.243-9.801,36.305-19.149
				c4.906-3.262,6.238-9.883,2.976-14.788c-3.263-4.907-9.884-6.237-14.788-2.976c-13.119,8.722-26.127,14.99-31.179,16.655
				c-1.989,0.657-3.747,1.258-5.307,1.79c-0.778,0.266-1.586,0.542-2.364,0.803c-0.555-1.411-1.188-3.023-1.951-4.853l-11.586-27.8
				c-1.219-2.925-3.676-5.157-6.704-6.091c-3.031-0.933-6.316-0.471-8.969,1.26C210.234,128.626,162.91,136.752,141.719,139.762z
				 M386.622,455.476c-0.003,0.013-0.006,0.025-0.011,0.037l-10.546,35.15h-24.196l4.441-16.576
				c1.525-5.691-1.852-11.539-7.542-13.064c-5.694-1.526-11.54,1.853-13.064,7.542l-5.92,22.097H135.939l-10.524-35.078
				c-0.016-0.053-0.03-0.106-0.047-0.158l-15.031-50.097h23.512l5.92,22.096c1.277,4.766,5.586,7.909,10.297,7.909
				c0.913,0,1.843-0.118,2.767-0.367c5.691-1.524,9.068-7.373,7.542-13.064l-4.441-16.575h245.732L386.622,455.476z M411.14,447.995
				l15.081-50.266c0.969-3.23,0.354-6.729-1.659-9.434c-2.014-2.705-5.186-4.299-8.558-4.299H96.002
				c-3.372,0-6.545,1.594-8.558,4.299s-2.627,6.203-1.659,9.434l15.081,50.266H48.271c3.579-71.001,42.769-134.694,104.613-169.987
				c4.619,5.669,10.165,10.182,17.119,14.945c-10.396,5.405-20.314,11.795-29.485,19.017c-4.628,3.646-5.425,10.352-1.78,14.98
				c2.106,2.672,5.23,4.067,8.387,4.067c2.309,0,4.637-0.747,6.593-2.287c8.378-6.598,17.455-12.42,26.987-17.306l9.878-5.067
				c0.633,0.423,1.252,0.832,1.899,1.27l0.654,0.411c20.615,11.9,41.762,17.935,62.859,17.935c0.001,0,0.001,0,0.002,0
				c21.097,0,42.249-6.036,62.867-17.94l0.653-0.41c4.869-3.302,9.327-6.138,13.261-8.639c11.505-7.316,19.841-13.002,26.337-20.977
				c61.846,35.294,101.037,98.987,104.616,169.987H411.14z"></path>
                                                    <path d="M156.003,446.808c-5.691,1.526-9.066,7.376-7.54,13.066l1.246,4.645c1.278,4.765,5.587,7.907,10.297,7.907
				c0.914,0,1.844-0.118,2.769-0.367c5.691-1.526,9.066-7.376,7.54-13.066l-1.246-4.645
				C167.543,448.66,161.7,445.284,156.003,446.808z"></path>
                                                    <path d="M351.935,449.181c0.925,0.249,1.855,0.368,2.77,0.368c4.708,0,9.018-3.141,10.296-7.906l1.246-4.644
				c1.528-5.689-1.847-11.539-7.538-13.066c-5.688-1.53-11.538,1.849-13.066,7.538l-1.246,4.644
				C342.869,441.805,346.244,447.655,351.935,449.181z"></path>
                                                </g>
                                            </g>
                                        </g>
                            </svg>

                                </figure>
                                <div class="cs_servicename">
                                    our assistant
                                </div>
                                <div class="cs_description">
                                    That a reader will be distracted by the readable content of a page when looking at
                                    its layout.

                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cs_content">
                                <figure>

                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>
                                            <g>
                                                <g>
                                                    <path d="M458.671,214.24v-11.571c0-17.645-14.354-32-32-32H320v-53.337c0-5.891-4.775-10.667-10.667-10.667h-32.001V74.67
				c0-5.891-4.776-10.667-10.667-10.667H121.759L103.545,45.79c-4.164-4.165-10.918-4.165-15.084,0l-60.878,60.875H10.667
				C4.776,106.666,0,111.441,0,117.332v298.668c0,5.89,4.776,10.667,10.667,10.667h43.739c1.605,7.878,4.954,15.129,9.622,21.333
				H42.666C36.775,448,32,452.777,32,458.667s4.775,10.667,10.667,10.667h63.997c0.027,0,0.052-0.004,0.079-0.004
				c25.72-0.037,47.231-18.373,52.181-42.662h150.409h43.747c1.605,7.878,4.955,15.129,9.623,21.333H341.34
				c-5.89,0-10.667,4.776-10.667,10.667s4.776,10.667,10.667,10.667h63.997c0.027,0,0.053-0.004,0.08-0.004
				c25.72-0.037,47.231-18.373,52.181-42.662h43.735c5.891,0,10.667-4.776,10.667-10.667v-96.001v-42.669
				C512,245.679,488.896,219.336,458.671,214.24z M255.999,85.337v21.329h-91.576l-21.33-21.329H255.999z M96.003,68.417
				l13.788,13.787c0.005,0.005,0.011,0.011,0.016,0.016l24.446,24.446H57.754L96.003,68.417z M106.666,447.998
				c-17.646,0-32.001-14.354-32.001-31.998c0-17.646,14.355-32.002,32.001-32.002c17.644,0,31.998,14.356,31.998,32.002
				C138.663,433.644,124.309,447.998,106.666,447.998z M298.666,181.336v181.332h-72.543c-5.891,0-10.667,4.776-10.667,10.667
				s4.775,10.667,10.667,10.667h72.543v21.333H158.924c-4.955-24.316-26.503-42.668-52.258-42.668
				c-25.755,0-47.306,18.353-52.261,42.668H21.333V234.668h42.665c5.89,0,10.667-4.775,10.667-10.667
				c0-5.891-4.776-10.667-10.667-10.667H21.333v-21.332H149.33c5.891,0,10.667-4.775,10.667-10.667
				c0-5.891-4.775-10.667-10.667-10.667H21.333v-42.671h10.66c0.006,0,0.012,0,0.017,0h266.656V181.336z M353.08,405.334H320
				v-21.333h42.701C358.032,390.206,354.684,397.456,353.08,405.334z M437.337,416.035c-0.019,17.629-14.366,31.963-31.998,31.963
				c-17.645,0-32.001-14.354-32.001-31.998c0-17.619,14.311-31.955,31.919-32h0.08c0.01,0,0.019-0.001,0.028-0.001
				c17.621,0.014,31.953,14.346,31.972,31.967c0,0.012-0.001,0.022-0.001,0.034C437.336,416.012,437.337,416.023,437.337,416.035z
				 M490.667,405.334h-33.069c-4.956-24.316-26.504-42.668-52.259-42.668c-0.028,0-0.055,0.002-0.082,0.002h-85.258V192.003h106.672
				c5.882,0,10.667,4.785,10.667,10.667v10.666h-74.666c-5.89,0-10.667,4.775-10.667,10.667v95.998
				c0,5.891,4.776,10.667,10.667,10.667h127.995V405.334z M394.673,234.668v74.665h-21.334v-74.665H394.673z M490.667,309.333
				h-74.661v-74.665h31.999c23.524,0,42.662,19.138,42.662,42.663V309.333z"></path>
                                                    <path d="M184.397,384.001h6.658c5.89,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667h-6.658
				c-5.891,0-10.667,4.776-10.667,10.667S178.507,384.001,184.397,384.001z"></path>
                                                    <path d="M184.397,192.003h6.658c5.89,0,10.667-4.775,10.667-10.667c0-5.891-4.776-10.667-10.667-10.667h-6.658
				c-5.891,0-10.667,4.775-10.667,10.667C173.731,187.227,178.507,192.003,184.397,192.003z"></path>
                                                </g>
                                            </g>
                                        </g>
                            </svg>

                                </figure>
                                <div class="cs_servicename">
                                    our delivery
                                </div>
                                <div class="cs_description">
                                    That a reader will be distracted by the readable content of a page when looking at
                                    its layout.
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>





@endsection