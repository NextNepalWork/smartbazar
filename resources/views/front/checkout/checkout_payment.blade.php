@extends('layouts.app')
@section('title', 'Checkout Payment')

@section('content')
    <section class="registerpage-container  vendor-registerpage-container">
        <div class="container box-shadow mb mt-3">
            <section class="breadcrumbs ">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><span>Make Payment</span></li>
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
            <div class="row paymenting field p-3">


                <div class="col-md-6">
                    <div class="payment-method__container box-shadow">
                        <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">
                            Make Your Payment
                        </h4>
                        <div id="payment" class="checkout-payment col-12 p-2">
                            <form action="https://esewa.com.np/epay/main" method="POST">
                                <input value="{{ $total_amount }}" name="tAmt" type="hidden">
                                <input value="{{ $total_amount }}" name="amt" type="hidden">
                                <input value="0" name="txAmt" type="hidden">
                                <input value="0" name="psc" type="hidden">
                                <input value="0" name="pdc" type="hidden">
                                <input value="NP-ES-ONETECH" name="scd" type="hidden">
                                <input value="{{ $code }}" name="pid" type="hidden">
                                <input value="http://smartbazaar.com.np/checkout/success" type="hidden" name="su">
                                <input value="http://smartbazaar.com.np/checkout/fail" type="hidden" name="fu">
                                <button type="submit" class="btn btn-success" style="background: #1e7e34!important;border-radius: 5px!important;">E-Sewa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>

@endsection