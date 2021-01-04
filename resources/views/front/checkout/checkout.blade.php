@extends('layouts.app')
@section('title', 'Checkout')

@section('content')

    <section id="check-out" class="checkoutpage-container py-5">
        <div class="container check-out">
            <div class="d-sm-block d-md-block mb">
                <section class="breadcrumbs ">
                    <ul class="uk-breadcrumb">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </section>
            </div>
            @if(Cart::instance('prebooking')->count() || Cart::instance('default')->count())
                @if(Cart::instance('prebooking')->count() > 0)
                    <form action="{{route('checkout.update', Cart::content()->first()->options->order)}}" method="post"
                          class="add-address">
                        <input type="hidden" name="address_id"
                               value="{{ App\Model\Order::where('id', Cart::content()->first()->options->order)->first()->address_id }}">
                        @else
                            <form action="{{route('checkout.store')}}" method="post" class="add-address" id="msform">
                                <input type="hidden" name="address_id"
                                       value="{{ isset($shipping) ? $shipping->id : '' }}">
                                @endif
                                {{ csrf_field() }}
                                <ul class="liststyle--none progressbar" id="progressbar">
                                    <li class="actively">Address</li>
                                    <li>Payment</li>
                                    <li>Done</li>
                                    <div class="clearfix"></div>
                                </ul>
                                <div class="clearfix"></div>
                                @include('front.checkout.form')
                                @include('front.checkout.order_summary')
                                <fieldset class="mx-auto pt-3">
                                    <div class="jumbotron text-center box-shadow">
                                        <h1 class="display-3">Thank You!</h1>
                                        <p class=""><strong>Please check your email</strong> for further instructions on
                                            how to complete
                                            your account setup.</p>
                                        <hr>
                                        <p>
                                            Having trouble? <a href="">Contact us</a>
                                        </p>
                                        <p class="">
                                            <a class="uk-button" href="javascript:void(0)" role="button">Continue to
                                                homepage</a>
                                        </p>
                                    </div>
                                </fieldset>
                            </form>
                            @else
                                <div class="col-md-12 mx-auto">
                                    <div class="well text-center" style="padding:100px">
                                        <p><strong>Sorry! There is no item in your cart. </strong></p>
                                        <a href="{{ url('/') }}" class="btn btn-sm btn-success">Back to Shopping</a>
                                    </div>
                                </div>
                @endif
        </div>
    </section>

@endsection


@section('extra_scripts')
    <script>
        $(document).ready(function () {
            $('#shipping_address').change(function () {
                var shipAmount = $('#shipping_address').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ route('checkout.ship') }}",
                    data: {
                        location: shipAmount
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        $('#shipping_charge').html(data.amount.toLocaleString());
                        $('#ship_amnt').html(data.amount.toLocaleString());
                        $('#grand_total_value').html(data.grandTotal.toLocaleString());
                        $('#ship_amnt_total').html(data.grandTotal.toLocaleString());
                    }
                });
            });

        });
    </script>

@endsection