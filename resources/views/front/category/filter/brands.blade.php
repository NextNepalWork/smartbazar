<li>
    <a class="uk-accordion-title" href="#">
        <h5> Brand</h5>
    </a>
    <div class="uk-accordion-content brand__filter">
        @isset($brands)
        @foreach($brands as $brand)
            <label><input class="uk-checkbox item_filter brand" type="checkbox" name="brand" value="{{$brand->slug}}"> {{$brand->name}}</label>
        @endforeach
        @endisset
    </div>
</li>
