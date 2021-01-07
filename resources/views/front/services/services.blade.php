@extends('layouts.app')
@section('title', 'SmartBazaar')

@section('content')
    @if(Session('success'))
        <div class="notify">
            <div id="notif-messages" class="alert alert-success" style="display: block;">
                <span class="icon-circle-check mr-2"></span>
                <button type="button" class="close">×</button>
                {{ Session('success') }}
            </div>
        </div>
    @endif
    @if(Session('error'))
        <div class="notify">
            <div id="notif-messages" class="alert alert-error" style="display: block;">
                <span class="icon-circle-check mr-2"></span>
                <button type="button" class="close">×</button>
                {{ Session('error') }}
            </div>
        </div>
    @endif



    <div class="product-category white-product services-category">
        <div class="my-container">
            <h3 style="text-align: left" class="title">{{ $serviceCategory->name }}
            </h3>
            <div class="row">
                @foreach($services as $service)
                    @if(isset($service->getImage()->smallUrl))
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <article
                                    class="product type-product status-publish  instock sale shipping-taxable purchasable product-type-simple "
                            >
                                <div class="product-wrap">
                                    <div class="product-top">

                                        <figure>
                                            <a href="{{ route('service.show', ['slug' => $service->slug]) }}">
                                                <div class="product-image">
                                                    <img width="320" height="320"
                                                         src="{{ $service->getImage()->smallUrl }}"
                                                         class="attachment-shop_catalog size-shop_catalog" alt="">
                                                </div>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="product-meta">
                                        <div class="title-wrap">
                                            <h3 class="product-title">
                                                <a href="{{ route('service.show', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                                            </h3>
                                        </div>
                                    </div>

                                </div>
                            </article>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>




@endsection