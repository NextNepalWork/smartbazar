<div class="row" style="padding: 0 0 10px">
    <div class="col-12">
        {{-- <form action="{{ route('coupon.check') }}" method="get" id="coupon_form">
            {{ csrf_field() }}
            @foreach(Cart::instance('default')->content() as $cartContent)
                <input type="hidden" name="product_id[]" value="{{ $cartContent->id }}">
            @endforeach
            <input type="text" name="coupon_code" class="coupon_code uk-input"
                   id="coupon_code_text"
                   placeholder="Coupon code">
            <input type="submit" class="btn btn-sm coupon_btn float-right btn-primary my-2"
                   name="apply_coupon"
                   value="Apply Coupon">
                   
        <div id="msg">
        
        </div>
        </form> --}}
        <strong>Apply For Coupon</strong>
        <div class="float-right">
            @foreach(Cart::instance('default')->content() as $cartContent)
                <input type="hidden" name="product_id[]" value="{{ $cartContent->id }}">
            @endforeach
                <input type="text" name="coupon_code" class="coupon_code" id="coupon_code_text" placeholder="Coupon code" required>
                <a class="btn coupon_btn btn-primary btn-sm">Apply Coupon</a>
        </div>
        <div id="msg">                            
        </div>
        <div class="clearfix"></div>
    </div>
</div>