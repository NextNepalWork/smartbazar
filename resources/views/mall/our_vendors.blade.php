@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')

    <section class="three-columns mb">
        <div class="container-fluid">
            <div class="row  m-0">
                <div class="column">
                    <a href="{{ getConfiguration('category_ads_link_1') }}"><img
                                src="{{ url('storage') . '/' . getConfiguration('category_ads_image_2') }}"
                                alt="{{ getConfiguration('category_ads_2') }}"></a>
                </div>
                <div class="column">
                    <a href="{{ getConfiguration('category_ads_link_2') }}"><img
                                src="{{ url('storage') . '/' . getConfiguration('category_ads_image_3') }}"
                                alt="{{ getConfiguration('category_ads_3') }}"></a>
                </div>
                <div class="column">
                    <a href="{{ getConfiguration('category_ads_link_3') }}"><img
                                src="{{ url('storage') . '/' . getConfiguration('category_ads_image_4') }}"
                                alt="{{ getConfiguration('category_ads_4') }}"></a>
                </div>

            </div>
        </div>
    </section>

    <section class="section-welcome_mall">
        <section class="three-columns mb">

            <div class="container-fluid">
                <div class="row  m-0">
                    <div class="column">
                        <a href=""><img src="images/MDR.png" alt=""></a>
                    </div>
                    <div class="column">
                        <a href=""><img src="images/MDR.png" alt=""></a>
                    </div>
                    <div class="column">
                        <a href=""><img src="images/MDR.png" alt=""></a>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class=" row  section-welcome_mall-title topic-title d-flex justify-content-between">
                <div class="heading">
                    <h3>SmartBazaar Vendors</h3>
                </div>

            </div>

            <div uk-filter="target: .js-filter">

                <ul class="uk-subnav uk-subnav-pill justify-content-center mb-3">
                    {{--<li class="uk-active" uk-filter-control><a href="#">All</a></li>--}}
                    {{--<li uk-filter-control="[data-color='electronics']"><a href="#">Electronics</a></li>--}}
                    {{--<li uk-filter-control="[data-color='fashion']"><a href="#">fashion</a></li>--}}
                    {{--<li uk-filter-control="[data-color='home']"><a href="#">home</a></li>--}}
                </ul>

                <div class="js-filter row justify-content-between ">

                    @foreach($vendors as $value)

                        <div data-color="home" class="welcome_mall-item relative">
                            <a href="{{route('profile',$value->name)}}" class="welcome_mall-detail">
                                <div class="welcome_mall-detail--logo">

                                    <figure>
                                        <img src=" @if($value->company_images->first()){{asset('vendor_company_image/'.$value->company_images->first()->image)}} @endif "
                                             alt="">
                                    </figure>
                                </div>

                                <div class="welcome_mall-detail--name">
                                    <h4>{{$value->name}}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="dummy" data-color="electronics"></div>
                    <div class="dummy" data-color="electronics"></div>
                    <div class="dummy" data-color="electronics"></div>
                    <div class="dummy" data-color="electronics"></div>
                    <div class="dummy" data-color="electronics"></div>

                    <div class="dummy" data-color="fashion"></div>
                    <div class="dummy" data-color="fashion"></div>
                    <div class="dummy" data-color="fashion"></div>
                    <div class="dummy" data-color="fashion"></div>
                    <div class="dummy" data-color="fashion"></div>

                    <div class="dummy" data-color="home"></div>
                    <div class="dummy" data-color="home"></div>
                    <div class="dummy" data-color="home"></div>
                    <div class="dummy" data-color="home"></div>
                    <div class="dummy" data-color="home"></div>
                </div>

            </div>
        </div>
    </section>


@endsection
