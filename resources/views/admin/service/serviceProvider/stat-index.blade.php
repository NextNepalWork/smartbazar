@extends('admin.layouts.app')
@section('title', 'All Orders')

@section('content')
    @include('partials.message-success')
    @include('partials.message-error')

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $providerName }}  <small> All Orders ({{ $ordersCount }})</small></h3>
                        {{--<ul class="liststyle--none" style="display: flex;">--}}
                        {{--<li><a href="{{ route('service.order.index') }}" style="padding-right: 10px;">All <small></small></a></li>--}}

                        {{--<li><a href="" style="padding-right: 10px;">Pending <small>({{ $orderPendingCount }})</small></a></li>--}}
                        {{--<li><a href="{{ route('service.order.index2', ['status' => 'approve']) }}" style="padding-right: 10px;">Approved <small>({{ $orderApprovedCount }})</small></a></li>--}}
                        {{--<li><a href="{{ route('service.order.index2', ['status' => 'cancelled']) }}" style="padding-right: 10px;">Cancelled <small>({{ $orderCancelledCount }})</small></a></li>--}}
                        {{--<li><a href="{{ route('service.order.index2', ['status' => 'complete']) }}" style="padding-right: 10px;">Complete <small>({{ $orderCompleteCount }})</small></a></li>--}}

                        {{--</ul>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Location</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th class="sorting-false">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($serviceOrders as $order)
                            <tr>
                                <th>
                                    {{ $order->id }}
                                </th>
                                <th>
                                    {{ $order->service->name }}
                                </th>
                                <th>
                                    @php
                                    $status = \App\Model\ServiceUser::where('order_service_id', $order->id)->pluck('status')->first()
                                    @endphp
                                    @if( $status == 'pending' )
                                        <span class="label label-warning">{{ $status }}</span>
                                     @elseif( $status == 'approve' )
                                        <span class="label label-primary">{{ $status }}</span>
                                    @elseif( $status == 'complete' )
                                        <span class="label label-info">{{ $status }}</span>
                                    @elseif( $status == 'cancelled' )
                                        <span class="label label-danger">{{ $status }}</span>
                                    @endif
                                </th>
                                <th>
                                    {{ $order->user->first_name }} {{ $order->user->last_name }}
                                </th>
                                <th>
                                    {{ $order->locations->location }}
                                </th>
                                <th>
                                    {{ $order->times->time }}
                                </th>
                                <th>
                                    {{ $order->created_at }}
                                </th>
                                <th>
                                    <a href='{{ route('admin.service.order.edit', ['id' => $order->id]) }}' class='btn btn-xs btn-info mr-5'><span class='lnr lnr-pencil'></span></a>


                                </th>
                            </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Location</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th class="sorting-false">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')







@endpush