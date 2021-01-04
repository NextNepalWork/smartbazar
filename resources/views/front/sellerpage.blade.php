@extends('layouts.app')
@section('title', 'Sell With Us')

@section('content')

<section id="seller-page">
    <div class="container-fluid p-0">
        <div class="seller-banner">
            <a href="{{route('register')}}"><figure style="max-height:100%!important"><img src="{{asset('images/sellerpage/seller_new.png')}}" alt=""></figure></a>
        </div>
    </div>
    <div class="container">
        <div class="heading pb-3 mb-3 ">
            <h2 class="font-weight-bold">
                Reasons to join SmartBazaar
            </h2>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="seller-cat">
                    <figure><img src="{{asset('images/sellerpage/commission.png')}}" alt=""></figure>
                    <div class="info">
                        <div class="heading">
                            <h3>Low Commission Fees</h3>
                        </div>
                        <p class="text-muted">You pay commission fees only after your product is sold.Plus, we offer a low commission sales fee.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="seller-cat">
                    <figure><img src="{{asset('images/sellerpage/grow.png')}}" alt=""></figure>
                    <div class="info">
                        <div class="heading">
                            <h3>Free Registration</h3>
                        </div>
                        <p class="text-muted">No upfront registration or joining fee for a limited time. No hidden fees !.</p>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="seller-cat">
                    <figure><img src="{{asset('images/sellerpage/service.png')}}" alt=""></figure>
                    <div class="info">
                        <div class="heading">
                            <h3>Free Support</h3>
                        </div>
                        <p class="text-muted">Free education and support to upload your product in our website and mobile app.</p>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="seller-cat">
                    <figure><img src="{{asset('images/sellerpage/delivery.png')}}" alt="" height='80'></figure>
                    <div class="info">
                        <div class="heading">
                            <h3>Free Delivery</h3>
                        </div>
                        <p class="text-muted"> Free delivery from your shop to the customers.</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <div class="heading py-3">
                <h2 class="font-weight-bold">
                  Benefits
                </h2>
            </div>
            <div class="benefits">
                <ul>
                    <li><span>Digital presence:</span> Stay open online 24x7, 365 days a year: Customers can purchase your products at any time even when your shop is closed.  A new way for you to showcase your online presence without having your own website that also allows you to sell your products.
                    </li>
                    <li><span>Increase  Sales & Profit:</span> Increase customer reach and sales by catering your products to large customer segment and not just regular and nearby customers that will multiply your profit.
                    </li>
                    <li><span> Effective Online sales platform:</span> The trend of online shops is increasing day by day. The facilities in our app/website is the most effective solution in Nepal. Thousands of customers using our application/website will have access to details of your shops such as address, map location, phone number, type of products you sell, product display along with special deals posted from your store.
                    </li>
                    <li><span>Competitive Edge: </span> To stay ahead in the competition, online presence is a must in today’s market. Become a member of elite network and get competitive edge over shops that are not in our network.
                    </li>
                    <li><span>Effective Advertising & Marketing:</span> Post deals, discounts anytime on your own and reach out to thousands of customers that is more effective and economic than posting ads in newspapers, radio, television etc.
                    </li>
                    <li><span>Strengthen Brand: </span> Establish and strengthen your brand by showcasing your products attractively through our website & app that will make your shop popular among thousands within short span of time.
                    </li>

                  </ul>
               

            </div>
            </div>
            
        </div>
        
    </div>
 
      <div class="container banner ">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-12 pt-3 text-center">
                 <div class="button-seller  w-50 mx-auto ">
                    <a href="{{route('sell.index')}}" class="d-block p-2">
                        <img src="{{asset('images/sellerpage/register_new.png')}}" alt="">
                    </a>
                </div>
             
            </div>
            <div class="col-md-6  col-sm-12 d-flex justify-content-center align-self-center">
                <img src="{{asset('images/sellerpage/notsure.png')}}" class="notsure p-sm-5 p-2 w-75 mb-5 ">
            </div>

        </div>
    </div>
</section>
@endsection