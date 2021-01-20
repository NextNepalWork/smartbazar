<div class="product-category white-product cat-page" id="productData" >

    @if($products->count()>0)
        @foreach($products as $product)
            <article class="product instock sale purchasable">
                <div class="product-wrap">
                    <div class="product-top">
                        <figure>
                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                <div class="product-image">
                                    <img width="320" height="320"
                                         src="{{ $product->getImageAttribute()->mediumUrl }}"
                                         class="attachment-shop_catalog size-shop_catalog" alt="{{ $product->name }}">
                                </div>
                            </a>
                        </figure>
                    </div>
                    <div class="product-description">
                        <div class="product-meta">
                            <div class="title-wrap">
                                <p class="product-title">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="line-clamp1" >{{ $product->name }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="product-meta-container">
                            <div class="product-price-container">
                                <span class="price">
                                    @if($product->sale_price == $product->product_price)
                                    <span class="Price-amount amount">
                                            <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}</span>
                                    {{-- <span class="Price-amount discount">
                                        <span class="Price-currencySymbol">Rs</span>
                                        {{ number_format($product->product_price) }}
                                    </span> --}}
                                    @else
                                    <span class="Price-amount discount">
                                        <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->product_price) }}
                                    </span>
                                    <span class="Price-amount amount">
                                            <span class="Price-currencySymbol">Rs&nbsp;</span>{{ number_format($product->sale_price) }}</span>
                                    
                                    @endif
                                </span>   
                                <div class="save-upto">
                                    @if($product->product_price>$product->sale_price)
                                        @php
                                            $discount = $product->product_price-$product->sale_price;
                                            $discount_percentage = $discount/$product->product_price*100;
                                        @endphp
                                        <span class="product-label discount">-{{ number_format($discount_percentage,2)}}%</span>
                                        @else
                                        <span class="product-label discount"></span>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

        @endforeach
</div>


<div class="clearfix"></div>
<div class="pagination-wrapper" style="width:100%">
<div class="pagination" id="pagination">
    {{ $products->setPath(Request::fullUrl() )->links() }}
</div>
</div>

@else
<div class="product-category white-product p-4">
    <div class="alert alert-danger alert-status text-center mx-auto ">No Products Found</div>
</div>
@endif