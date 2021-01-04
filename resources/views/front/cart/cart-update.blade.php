<a href="{{ route('cart') }}" class="user-cart-link">
    <i>
        <svg height="30" width="30" aria-hidden="true" focusable="false"
             data-prefix="fab" data-icon="opencart"
             class="svg-inline--fa fa-opencart fa-w-20" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path fill="currentColor"
                  d="M423.3 440.7c0 25.3-20.3 45.6-45.6 45.6s-45.8-20.3-45.8-45.6 20.6-45.8 45.8-45.8c25.4 0 45.6 20.5 45.6 45.8zm-253.9-45.8c-25.3 0-45.6 20.6-45.6 45.8s20.3 45.6 45.6 45.6 45.8-20.3 45.8-45.6-20.5-45.8-45.8-45.8zm291.7-270C158.9 124.9 81.9 112.1 0 25.7c34.4 51.7 53.3 148.9 373.1 144.2 333.3-5 130 86.1 70.8 188.9 186.7-166.7 319.4-233.9 17.2-233.9z"></path>
        </svg>
    </i>
</a>
<div class="cart-count">
    <span>{{count(\Gloudemans\Shoppingcart\Facades\Cart::content())}}</span>
</div>
<div class="user_cart_dd">
    @if(Cart::instance('default')->count())
    <ul class="user_cart_ul">
        @foreach(Cart::content() as $cartContent)
        <li>
            <figure style="float: left; margin-right: 10px; width: 50px;"><img
                        src="{{ asset(getProductImage($cartContent->id, 'small')) }}"
                        alt="{{ $cartContent->name }}"></figure>
            <p class="text-left">
                <span> {{ $cartContent->name }}</span><br>
                <span>{{ $cartContent->qty }}</span> <span>*</span> <span>{{ $cartContent->price }}</span>

            </p>
            <div class="clearfix"></div>
            <hr>
        </li>
        @endforeach
    </ul>
    <div class="cart_subtotal">
        <div class="float-left">Subtotal</div>
        <div class="float-right"><span class=""><span class="">Rs.</span>{{ Cart::instance('default')->total() }}</span>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div>
    <a href="{{ route('cart') }}" class="btn  btn-default view-cart float-left">View Cart</a>
    <a href="{{ route('checkout') }}" class="btn btn-danger checkout float-right">Checkout</a>
    <div class="clearfix"></div>
    @else
        <div class="cart-empty">
            <p class="mb-none">No products in cart.</p>
        </div>
    @endif
</div>