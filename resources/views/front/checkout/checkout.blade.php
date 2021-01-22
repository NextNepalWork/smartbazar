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

            // coupon function
            // $('.coupon_btn').click(function(e){
            //     e.preventDefault();
            //     var values = $("input[name='product_id[]']")
            //         .map(function(){return $(this).val();}).get();
            //     var coupon = $("input[name=coupon_code").val();


            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: 'get',
            //         url: "{{ route('coupon.check.ajax') }}",
            //         data: {
            //             product_id: values,
            //             coupon_code:coupon
            //         },
            //         // beforeSend: function (data) {
            //         //     $(this).button('loading');
            //         // },
            //         success: function (data) {
            //             if (data.status=='error') {
            //                 $('#msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' + data.message +
            //                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            //                 '<span aria-hidden="true">&times;</span>'+
            //                 '</button>'+
            //                  '</div>');                        
            //                 //  $('#coupon_form').reset();
            //                 // $(this).prop('disabled', true);
            //                 // $('.alert.alert-danger').fadeOut();
            //                 // $('.alert.alert-success').fadeIn();
            //             }
            //             if(data.status=='success') {
            //                 $('#msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert">' + data.message +
            //                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            //                 '<span aria-hidden="true">&times;</span>'+
            //                 '</button>'+
            //                  '</div>');
            //                  $('.cart-summary').load(location.href  + ' .cart-summary');
            //                 //  $('#coupon_form').reset();
            //                 // $(this).prop('disabled', true);
            //                 // $('.alert.alert-success').fadeOut();
            //                 // $('.alert.alert-success').fadeIn();
            //                 // setTimeout(function () {
            //                 // location.reload()
            //                 // }, 2000);
            //             }

            //         },
            //         error: function (xhr, ajaxOptions, thrownError) {
            //             // var errorsHolder = '';
            //             // errorsHolder += '<ul>';

            //             // var err = eval("(" + xhr.responseText + ")");
            //             // $.each(err.errors, function (key, value) {
            //             //     errorsHolder += '<li>' + value + '</li>';
            //             // });

            //             // errorsHolder += '</ul>';

            //             // $('.alert.alert-danger').fadeIn().html(errorsHolder);
            //         }
            //         // ,
            //         // complete: function () {
            //         //     // $("form")[0].reset(),
            //         //     // $(this).button('reset');
            //         //     // $("html, body").animate({scrollTop: 0}, "slow");
            //         // }
            //     });

            // });

        });
    </script>

@endsection