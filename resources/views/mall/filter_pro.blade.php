@foreach($products as $value)

    <article class="product instock sale purchasable">
        <div class="product-wrap">
            <div class="product-top">
                <figure>
                    <a href="">
                        <div class="product-image">
                            <img width="320" height="320"
                                 src="{{$value->getImageAttribute()->mediumUrl}}"
                                 class="attachment-shop_catalog size-shop_catalog"
                                 alt="">
                        </div>
                    </a>
                </figure>
            </div>
            <div class="product-description">
                <div class="product-meta">
                    <div class="title-wrap">
                        <p class="product-title">
                            <a href="singlepage.html">{{$value->name}}</a>
                        </p>
                    </div>
                </div>
                <div class="product-meta-container">
                    <div class="product-price-container">
                         

                                <span class="price">
                                     @if($value->sale_price == $value->product_price)


                                        <span class="Price-amount amount">
                                            <span class="Price-currencySymbol">Rs</span>{{$value->sale_price}}</span>

                                
                                @else
                                 <span class="Price-amount discount">
                                            <span class="Price-currencySymbol">Rs</span>{{$value->product_price}}
                                        </span>


                                        <span class="Price-amount amount">
                                            <span class="Price-currencySymbol">Rs</span>{{$value->sale_price}}</span>
                                @endif
                                </span>

                        <div class="save-upto">
                                        @if($value->product_price>$value->sale_price)
                                            @php
                                                $discount = $value->product_price-$value->sale_price;
                                                $discount_percentage = $discount/$value->product_price*100;
                                            @endphp
                                            <span >-{{ number_format($discount_percentage)}}%</span>
                                            @else
                                            <span></span>

                                        @endif
                                    </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endforeach
