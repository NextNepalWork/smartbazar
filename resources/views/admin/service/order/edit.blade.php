@extends('admin.layouts.app')
@section('title', 'All Orders')

@section('content')
    @include('partials.message-success')
    @include('partials.message-error')

<section class="content">
    <div class="row">
        <form method="POST" action="{{ route('admin.service.order.update') }}" accept-charset="UTF-8" class="form-order" _lpchecked="1">
            {{ csrf_field() }}
            <input name="order_id" type="hidden" value="{{ $orderService->id }}">
            <div class="col-md-12">
                <div class="box content__box content__box--shadow">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Details</h3>
                        <a href="http://localhost:8000/admin/order/67/invoice" class="btn btn-default pull-right" title="Generate a pdf invoice" target="_blank">
                            <svg class="svg-inline--fa fa-print fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="print" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 192h-16V81.941a24 24 0 0 0-7.029-16.97L383.029 7.029A24 24 0 0 0 366.059 0H88C74.745 0 64 10.745 64 24v168H48c-26.51 0-48 21.49-48 48v132c0 6.627 5.373 12 12 12h52v104c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V384h52c6.627 0 12-5.373 12-12V240c0-26.51-21.49-48-48-48zm-80 256H128v-96h256v96zM128 224V64h192v40c0 13.2 10.8 24 24 24h40v96H128zm304 72c-13.254 0-24-10.746-24-24s10.746-24 24-24 24 10.746 24 24-10.746 24-24 24z"></path></svg><!-- <i class="fa fa-print"></i> --> Print Invoice
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="col-md-5">
                            <h4>General Details</h4>

                            <div class="form-group">
                                <label for="order_date" class="control-label">Order Date</label>
                                <input class="form-control" placeholder="Order Date" name="order_date" type="text" value="{{ $orderService->created_at }}" id="order_date">

                            </div>

                            <div class="form-group">
                                <label for="order_status" class="control-label">Order Status</label>
                                <select name="order_status" class="form-control select2" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="" @if($orderService->status == null) selected  @endif>Select Order Status</option>
                                    <option value="pending" @if($orderService->status == 'pending') selected  @endif>pending</option>
                                    <option value="approve" @if($orderService->status == 'approve') selected  @endif>approved</option>
                                    <option value="complete" @if($orderService->status == 'complete') selected  @endif>complete</option>
                                    <option value="cancelled" @if($orderService->status == 'cancelled') selected  @endif>cancelled</option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="order_status" class="control-label">Assign Provider</label>
                                <select name="provider_id" class="form-control select2" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Select Service Provider</option>
                                    @foreach($serviceUsers as $user)
                                    <option value="{{ $user->id }}" @if( $user->id == $provider_id) selected @endif>{{ $user->user->first_name }} {{ $user->user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_date" class="control-label">Service Provider Status </label>
                                <input class="form-control" placeholder="Order Date" name="order_date" type="text" value="{{ $orderService->created_at }}" id="order_date">

                            </div>

                        </div>
                        <div class="col-md-7">
                            <h4>Address Details</h4>
                            <div class="address-details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="control-label">First Name</label>
                                            <input class="form-control" name="first_name" type="text" value="{{ $orderService->shippingAccount->first_name }}" id="first_name">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" class="control-label">Last Name</label>
                                            <input class="form-control" name="last_name" type="text" value="{{ $orderService->shippingAccount->last_name }}" id="last_name">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input class="form-control" name="email" type="text" value="{{ $orderService->user->email }}" id="email">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="control-label">Phone</label>
                                            <input class="form-control" name="phone" type="text" value="{{ $orderService->shippingAccount->mobile }}" id="phone">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landmark" class="control-label">Landmark</label>
                                            <input class="form-control" name="landmark" type="text" value="{{ $orderService->shippingAccount->landmark }}" id="landmark">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street_name" class="control-label">Street Name</label>
                                            <input class="form-control" name="street_name" type="text" value="{{ $orderService->shippingAccount->street_name }}" id="street_name">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="control-label">City</label>
                                            <input class="form-control" name="city" type="text" value="{{ $orderService->shippingAccount->city }}" id="city">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landline" class="control-label">Landline</label>
                                            <input class="form-control" name="landline" type="text" value="{{ $orderService->shippingAccount->landline }}" id="landline">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <!-- /.box -->
                <div class="box content__box content__box--shadow">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-hover table-order">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Location</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="item" data-product="81">
                                <td class="color" width="1%" >
                                    <span>1</span>
                                </td>
                                <td class="name" width="1%">
                                    <a href="http://localhost:8000/product/hoodie">{{ $orderService->service->name }}</a>
                                </td>

                                <td class="thumb" width="1%">
                                    <div class="thumbnail mb-none">
                                        <img src="{{ $orderService->service->getImage()->url }}" class="img-responsive" alt="" title="">
                                    </div>
                                </td>
                                <td class="color" width="1%">
                                    <span>{{ $orderService->locations->location }}</span>
                                </td>
                                <td class="size" width="1%">
                                    <span>{{ $orderService->times->time }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                    </div>
                    <!-- /.box-body -->
                    <div class="clearfix"></div>
                </div>
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <input id="btn-order-save"  class="btn btn-danger pull-right" data-loading-text="Loading..." type="submit" value="Update">
                    </div>
                </div>
            </div>            </form>
    </div>
    <!-- /.row -->
</section>

@endsection