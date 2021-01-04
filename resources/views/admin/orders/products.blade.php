@foreach($products as $product)
    @php
        if (Route::currentRouteName() == 'dashboard.order.create'){
            $price = $product->sale_price;
        } else{
            $price = isset($product->sale_price) ? $product->sale_price : $product->product_price;
        }
    @endphp
    <tr class="item" data-product="{{ $product->id }}">
        <td class="thumb" width="2%">
            <div class="thumbnail mb-none">
                <img src="{{ getProductImage($product->id, 'smallUrl') }}" class="img-responsive" alt="" title="">
            </div>
        </td>
        <td class="name" width="7%">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </td>
        
        <td class="merchant" width="2%">
            <span>{{ isset(\App\Model\Vendor::where('user_id',$product->user_id)->first()->name) ? \App\Model\Vendor::where('user_id',$product->user_id)->first()->name : 'N/A' }}</span>
        </td>
        <td class="color" width="1%">
            <span>{{ isset($product->additionals->first()->color) ? $product->additionals->first()->color : 'N/A' }}</span>
        </td>
        <td class="size" width="1%">
            <span>{{ isset($product->additionals->first()->size) ? $product->additionals->first()->size : 'N/A'  }}</span>
        </td>
        <td class="item_cost" width="1%">
            <span>RS{{ $price }}</span>
            <input type="hidden" name="price" value="{{ $product->price }}">
        </td>
        <td class="quantity" width="1%">
            <div class="view">
                <input type="number" name="quantity" value="{{ isset($product->quantity) ? $product->quantity : 1 }}" min="1" class="form-control">
            </div>
        </td>
        <td class="discount" width="2%">
            <div class="view">
                <input type="number" name="discount" value="{{ isset($product->discount) ? $product->discount : 0 }}" min="0" class="form-control">
            </div>
        </td>
        <td class="tax" width="2%">
            <div class="view">
                <input type="number" name="tax" value="{{ isset($product->orderProduct->first()->tax) ? $product->orderProduct->first()->tax : 0 }}" min="0" class="form-control">
            </div>
        </td>
        @php
        $start_price = $price;

        $tax = 0;
        @endphp
        @php
            if (Route::currentRouteName() != 'admin.order.add.product'){
            $actualPrice = $start_price * $product->quantity;
                $tax = $actualPrice * ($product->orderProduct->first()->tax / 100);
            }
            else
            {
                $actualPrice = $start_price;
            }
        @endphp
        @php
        $price_after_tax = $actualPrice + $tax;
        $total_price = $price_after_tax - $product->discount;
        @endphp
        <td class="line_cost" width="1%">
            <div class="view">
                Rs {{ number_format($total_price, 2) }}
            </div>
        </td>
        <td class="order-actions" width="3%">
            <button type="button" class="btn btn-sm btn-info update-order-item">
                Update
            </button>
            <button type="button" class="btn btn-sm btn-danger delete-order-item">
                <span class="lnr lnr-trash"></span>
            </button>
        </td>
    </tr>
@endforeach