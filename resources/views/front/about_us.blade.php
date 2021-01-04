@extends('layouts.app')
@section('title', 'About Us')

@section('content')

    <section id="about-section" class="about_section">
        <div class="container pt-3">
            <section class="breadcrumbs ">
                <ul class="uk-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Option</a></li>
                    <li><span>Active</span></li>
                </ul>
            </section>
            <div class="heading pt-3">
                <h3> About us</h3>
            </div>
            <hr>
        </div>
        <div class="container mb">
            <!--<div class="row">-->
            <!--    <div class="col-12">-->
            <!--        <div class="our-history">-->
            <!--            <h4> Our history</h4>-->
            <!--            <p>{!! getConfiguration('who_we_are') !!}</p>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="our-vision mb">
                <div class="row">
                    <div class="col-md-8 col-sm-8">

                        <h4> Our Vision</h4>

                        <p>{!! getConfiguration('our_mission') !!}</p>

                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img src="https://mutarecity.co.zw/images/vision2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>
    <!--<section class="team-area section-gap team-page-teams mb" id="team">-->
    <!--    <div class="container">-->
    <!--        <div class="row d-flex justify-content-center">-->
    <!--            <div class="menu-content ">-->
    <!--                <div class="text-center heading">-->
    <!--                    <h3 class="mb-3">Experienced Mentor Team</h3>-->

    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            @foreach($about as $value)-->
    <!--                <div class="col-md-3 col-sm-6  ">-->
    <!--                    <div class="single-team">-->
    <!--                        <div class="thumb">-->
    <!--                            <img src="{{$value->getImage()->mediumUrl}}" alt="">-->
    <!--                            <div class="align-items-center justify-content-center d-flex">-->
    <!--                                <a href="{{$value->facebook_link}}"><i class="fab fa-facebook-f"></i></a>-->
    <!--                                <a href="{{$value->twitter_link}}"><i class="fab fa-twitter"></i></a>-->
    <!--                                <a href="{{$value->linkedin_link}}"><i class="fab fa-linkedin"></i></a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="meta-text mt-30 text-center">-->
    <!--                            <h4>{{$value->name}}</h4>-->
    <!--                            <p>{{$value->position}}</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            @endforeach-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

@endsection

