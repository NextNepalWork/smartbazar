@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')

    <section class="section-collection">
        <div class="container-fluid">
            <div class="d-flex section-collection-tittle topic-title justify-content-between">
                <div class="heading">
                    <h3 class="text-white">Collection</h3>
                </div>
            </div>
            <div class="row    ">
                @foreach($category as $value)

                    <div class=" col-lg-3 col-md-4 col-sm-4 col-6">
                        <div class="collections-item">
                            <a class="collections-link" href="{{ url('/') . '/category/' . $value->slug }}">
                                <div class="collections-product">
                                    <figure>
                                        <img src="{{asset('images/category/'.$value->category_image)}}"
                                             alt="">
                                    </figure>
                                </div>
                                <div class="collections-title">{{$value->name}}</div>
                                <div class="collections-subtitle"
                                >
                                    {{count($value->products)}}
                                </div>


                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="btn btn-outline-primary center mb-4">
        load more
    </div>



@endsection
