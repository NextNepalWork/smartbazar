@foreach($products as $product )
    <article class="product instock sale purchasable">
        <div class="product-wrap">
            @if($product->negotiable == 1)
                <div class="ribbon ribbon-top-left"><span>Bargain</span></div>
            @endif
            @php
            $discount = round(($product->product_price-$product->sale_price)/$product->product_price*100,0);

            @endphp
            @if($discount != 0)
            <div class="dis-tag">
                <figure><img src="{{asset('images/tags/tag.png')}}" alt=""></figure>
                
                <span class="dis-tag-price">{{$discount}}
                    %</span>
                    
            </div>
            @endif
            <div class="product-top">

                <figure>
                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                        <div class="product-image">
                            <img width="320" height="320"
                                 src="{{ $product->getImageAttribute()->mediumUrl }}"
                                 class="attachment-shop_catalog size-shop_catalog"
                                 alt="{{ $product->name }}">
                        </div>
                    </a>
                </figure>
            </div>
            <div class="product-description">
                <div class="product-meta">
                    <div class="title-wrap">
                        <p class="product-title">
                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                               class="line-clamp1">{{ $product->name }}</a>
                        </p>
                    </div>
                </div>
                <div class="product-meta-container">
                    <div class="product-price-container">
                        <span class="price">
                            @if($product->product_price == $product->sale_price)
                                <span class="Price-amount amount">
                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                </span>
                            @else
                                <span class="Price-amount discount">
                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                </span>
                                <span class="Price-amount amount">
                                    <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}
                                </span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endforeach