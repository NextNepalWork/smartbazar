<fieldset>
    <div class="row">

        <div class="col-md-7 col-sm-12 deliver__address" style="margin-bottom:10px; background: white">
            <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0;">Information</h4>
            <div class="row">
                <div class="col-sm-6 col-12 form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="fname">First Name</label>
                    <input type="text" name="first_name" id="fname" class="uk-input" placeholder="First name"
                           value="{{ isset($shipping->first_name)?$shipping->first_name:'' }}">
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                        {{ $errors->first('first_name') }}
                    </span>
                    @endif
                </div>
                <div class="col-sm-6 col-12">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="last_name" class="uk-input" placeholder="Last name"
                           value="{{ isset($shipping->last_name)?$shipping->last_name:'' }}">
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                        {{ $errors->first('last_name') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="email" class="uk-input" id="inputEmail"
                           value="{{ isset($shipping->email)?$shipping->email:'' }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                    @endif

                </div>
                <div class="col-sm-6 col-12">
                    <label for="country">Country</label>
                    <select class="uk-select" id="country" name="country">
                        <option value="Nepal">Nepal</option>
                        <option value="India">India</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="USA">USA</option>
                    </select>
                    @if ($errors->has('country'))
                        <span class="help-block">
                      {{ $errors->first('country') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <label for="inputAddress">Zone</label>
                    <input type="text" name="zone" class="uk-input" id="inputAddress"
                           value="{{ isset($shipping->zone)?$shipping->zone:'' }}" placeholder="Zone">
                    @if ($errors->has('zone'))
                        <span class="help-block">
                        {{ $errors->first('zone') }}
                    </span>
                    @endif
                </div>
                <div class="col-sm-6 col-12">
                    <label for="inputdistrict">District</label>
                    <input type="text" name="district" class="uk-input" id="inputdistrict"
                           value="{{ isset($shipping->district) ? $shipping->district : '' }}" placeholder="District">
                    @if ($errors->has('district'))
                        <span class="help-block">
                        {{ $errors->first('district') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <label for="inputArea">Area</label>
                    <input type="text" name="area" class="uk-input" id="inputArea"
                           value="{{ isset($shipping->area)?$shipping->area:'' }}" placeholder="Area">
                    @if ($errors->has('area'))
                        <span class="help-block">
                        {{ $errors->first('area') }}
                    </span>
                    @endif

                </div>
                <div class="col-sm-6 col-12">
                    <label for="locationType">Location Type</label>
                    <select class="uk-select" id="locationType" name="location_type">
                        <option value="1">Home</option>
                        <option value="2">Business</option>
                    </select>
                    @if ($errors->has('location_type'))
                        <span class="help-block">
                        {{ $errors->first('location_type') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <label for="mobile">Mobile *</label>
                    <input type="text" name="mobile" class="uk-input" id="mobile"
                           value="{{ isset($shipping->mobile)?$shipping->mobile:'' }}" placeholder="Mobile">
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                        {{ $errors->first('mobile') }}
                    </span>
                    @endif

                </div>
                <div class="col-sm-6 col-12">
                    <label for="phone">Mobile 2</label>
                    <input type="text" name="phone" class="uk-input" id="phone"
                           value="{{ isset($shipping->phone)?$shipping->phone:'' }}" placeholder="Mobile 2">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                        {{ $errors->first('phone') }}
                    </span>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="shipping_address">Shipping Place *</label>
                    <label for=""><em>Shipping charge varies according with shipping location</em></label>
                    <select class="uk-select" id="shipping_address" name="shipping_address">
                        <option selected> Select Shipping Location</option>
                        @foreach($shipping_places as $shipping_amount)
                            <option value="{{ $shipping_amount->place }}"> {{ $shipping_amount->place }} <span
                                        class="pull-right"> (Rs. {{ $shipping_amount->amount }} )</span>
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('shipping_address'))
                        <span class="help-block">
                        {{ $errors->first('shipping_address') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="button" class="uk-button next submit">Save this address</button>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12 ">
            <div class="box-shadow">
                <div class="card-header" style="margin-bottom: 10px;">
                    <h4 style="background: #f1f1f1;padding: 15px;color: black;margin: 0 0 10px 0;">Your
                        order</h4>                      <div class="float-right">
                        <small><a class="afix-1" href="{{ route('cart') }}">Edit Cart</a></small>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-block">
                    <div class=" group">
                        @php
                            $tax = 0;
                            $subtotal = 0;
                        @endphp
                        @if(Cart::instance('default')->count() > 0)
                            @foreach(Cart::instance('default')->content() as $cartContent)
                                @php
                                    $prebooking = App\Model\Product::findOrFail($cartContent->id)->prebooking;
                                @endphp
                                <div class="row">
                                    <div class="col-sm-3 col-3">
                                        <img class="img-fluid"
                                             src="{{ asset(getProductImage($cartContent->id, 'small')) }}"
                                             alt="{{ $cartContent->name }}"/>
                                    </div>
                                    <div class="col-sm-6 col-6">
                                        <div class="col-12">{{ $cartContent->name }}</div>
                                        <div class="col-12">
                                            <small>Quantity:<span>{{ $cartContent->qty }}</span></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-3 text-right">
                                        @if($prebooking == 1)
                                            <h6>
                                                <span>Rs.</span>{{ (($cartContent->price * $cartContent->qty) * 10) / 100 }}
                                            </h6>
                                            (10% of Rs. {{ $cartContent->price }})
                                            <small>Prebooking</small>
                                        @else
                                            <h6><span>Rs.</span>{{ $cartContent->price }}</h6>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr>
                                @php
                                    if($prebooking == 1) {
                                        $actualprice = (($cartContent->price * $cartContent->qty) * 10) / 100;
                                        $subtotal += $actualprice;
                                        $tax += 0;
                                    }
                                    else {
                                        $actualprice = $cartContent->price * $cartContent->qty;
                                        $subtotal += $actualprice;
                                        $tax += ((($cartContent->price * $cartContent->qty) * App\Model\Product::findOrFail($cartContent->id)->tax) / 100);
                                    }
                                @endphp
                            @endforeach
                        @endif
                        @if(Cart::instance('prebooking')->count() > 0)
                            @foreach(Cart::instance('prebooking')->content() as $cartContent)
                                @php
                                    $prebooking = App\Model\Product::findOrFail($cartContent->id)->prebooking;
                                @endphp
                                <div class="row">
                                    <div class="col-sm-3 col-3">
                                        <img class="img-fluid"
                                             src="{{ asset(getProductImage($cartContent->id, 'small')) }}"
                                             alt="{{ $cartContent->name }}"/>
                                    </div>
                                    <div class="col-sm-6 col-6">
                                        <div class="col-12">{{ $cartContent->name }}</div>
                                        <div class="col-12">
                                            <small>Quantity:<span>{{ $cartContent->qty }}</span></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-3 text-right">
                                        @if($prebooking == 1)
                                            <h6>
                                                <span>Rs.</span>{{ (($cartContent->price * $cartContent->qty) * 10) / 100 }}
                                            </h6>
                                            (10% of Rs. {{ $cartContent->price }})
                                            <small>Prebooking</small>
                                        @else
                                            <h6><span>Rs.</span>{{ $cartContent->price }}</h6>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <hr>
                                @php
                                    if($prebooking == 1) {
                                        $actualprice = (($cartContent->price * $cartContent->qty) * 10) / 100;
                                        $subtotal += $actualprice;
                                        $tax += 0;
                                    }
                                    else {
                                        $actualprice = $cartContent->price * $cartContent->qty;
                                        $subtotal += $actualprice;
                                        $tax += ((($cartContent->price * $cartContent->qty) * App\Model\Product::findOrFail($cartContent->id)->tax) / 100);
                                    }
                                @endphp
                            @endforeach
                        @endif
                    </div>
                    @php
                        $grandTotal = $subtotal + $tax;
                    @endphp

                    <div class="row">
                        <div class="col-12">

                            <strong>Subtotal</strong>
                            <div class="float-right"><span>Rs.</span><span>{{ $subtotal }}</span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-12">
                            <strong>Tax</strong>
                            <div class="float-right"><span>Rs.</span><span>{{ number_format($tax,2)  }}</span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-12">
                            <small>Shipping</small>
                            <div class="float-right"><span class="item-price">Rs. <span
                                            id="shipping_charge"> 0.00</span> </span></div>
                            <div class="clearfix"></div>
                        </div>
                        @if(session()->exists('coupon'))
                            <div class="col-12">
                                <small>Discount</small>
                                <div class="float-right"><span class="item-price">Rs. <span
                                                id="discount"> {{ number_format(session()->get('coupon')['discount_value'], 2) }}</span> </span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                    </div>
                    <hr>

                    <div class="row" style="padding: 0 0 10px">
                        <div class="col-12">
                            <strong>Order Total</strong>
                            <div class="float-right"><span>Rs.</span><span
                                        id="grand_total_value">{{ session()->exists('coupon') ? number_format($grandTotal - session()->get('coupon')['discount_value'], 2) : number_format($grandTotal, 2) }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <hr>

                    <div class="row" style="padding: 0 0 10px">
                        <div class="col-12">
                            <strong>Apply For Coupon</strong>
                            <div class="float-right">
                                    <input type="text">
                                    <button class="btn btn-primary btn-sm">Apply</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="order_note">Order Note</label>
                    <textarea name="order_note" class="form-control" id="order_note" rows="5"
                              placeholder="Additional things you want to say..."></textarea>
                    @if ($errors->has('order_note'))
                        <span class="help-block">
                        {{ $errors->first('order_note') }}
                    </span>
                    @endif

                </div>
            </div>
        </div>
    </div>
</fieldset>

