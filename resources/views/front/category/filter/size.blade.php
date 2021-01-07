<li>
    <a class="uk-accordion-title" href="#">
        <h5> Size</h5>
    </a>
    <div class="uk-accordion-content brand__filter">
        @if(isset($size))
            @foreach($size as $s)
                @if(!$s ==null)
                    <label><input class="uk-checkbox item_filter size" type="checkbox" name="size" value="{{$s->size}}"> {{$s->size}}</label>
                @endif
            @endforeach
        @endif
    </div>
</li>

