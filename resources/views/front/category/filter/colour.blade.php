<li>
    <a class="uk-accordion-title" href="#">
        <h5> Colour</h5>
    </a>
    <div class="uk-accordion-content brand__filter">
        @if(isset($colour))
            @foreach($colour as $c)
                @if(!$c ==null)
                    <label><input class="uk-checkbox item_filter colour" type="checkbox" name="colour" id="{{$c}}" style="border-color:{{$c}}; border-width: 2px;" value="{{$c}}"> {{$c}}</label>
                @endif
            @endforeach
        @endif
    </div>
</li>