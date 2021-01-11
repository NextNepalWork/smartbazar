@extends('layouts.app')

@section('content')
    <fieldset>
        <section class="content-box-row">
            <div class="content-box">
                <div class="row py-3">
                      <div class="mx-auto thank-you-border text-center">
                        <div class="thankyou--border-box">
            	            <span>
            	                <h1 class="display-4 pb-3" >Thank You</h1>
            	            </span>
                            <div class="content">
                                Thank You for your purchase! Your Order has been received.
                                Your order will be shipped to your address very soon.</br>
                                Your Order Track Number is: <strong>{{$code}}</strong>
                            </div>
                            <a href="{{route('user.account')}}">View Order Details</a>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </fieldset>
@endsection