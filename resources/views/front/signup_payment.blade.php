@extends('layouts.app')
@section('title', 'Sign Up Payment')

@section('content')
   {{$amount}}
    <section class="registerpage-container  vendor-registerpage-container">
        <div class="container box-shadow mb mt-3">
            <section class="breadcrumbs ">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><span>Sell With Us</span></li>
                </ul>
            </section>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{\Illuminate\Support\Facades\Session::get('success')}}</li>
                    </ul>
                </div>
            @endif
            <div class="row paymenting field">


                <div class="col-md-4">
                    <div class="payment-method__container box-shadow">
                        <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">
                            Payment method
                            <!--<a href="{{route('sell.method','esewa')}}">pay</a>-->
                        </h4>
                        <div id="payment" class="checkout-payment">
                            <ul class=" payment_methods liststyle--none uk-margin-bottom">

                                <li class="payment_method payment_method_cod">

                                    <a class="btn btn-default" href="{{route('sell.method',['pay_method'=>'COD','vendor_code'=>$vendor_code])}}">Cash On Delivery</a>
                                </li>
                                <li class="payment_method payment_method_cod">

                                   <form action="https://esewa.com.np/epay/main" method="POST">
        <input value="{{$amount}}" name="tAmt" type="hidden">
        <input value="{{$amount}}" name="amt" type="hidden">
        <input value="0" name="txAmt" type="hidden">
        <input value="0" name="psc" type="hidden">
        <input value="0" name="pdc" type="hidden">
        <input value="NP-ES-ONETECH" name="scd" type="hidden">
        <input value="{{$vendor_code}}" name="pid" type="hidden">
        <input value="http://smartbazaar.com.np/success" type="hidden" name="su">
        <input value="http://smartbazaar.com.np/fail" type="hidden" name="fu">
<button type="submit" class="btn btn-success">E-sewa</button>
    </form>
    <!--    <form action="https://esewa.com.np/epay/transrec" method="GET">-->
    <!--<input value="5" name="amt" type="hidden">-->
    <!--<input value="NP-ES-ANISHTEST" name="scd" type="hidden">-->
    <!--<input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">-->
    <!--<input value="03HP1AZ" name="rid" type="hidden">-->
    <!--<input value="Submit" type="check">-->
    <!--</form>-->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>

@endsection