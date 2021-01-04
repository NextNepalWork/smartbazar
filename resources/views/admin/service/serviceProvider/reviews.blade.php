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
                        <h3 class="box-title">{{ $providerName }}  <small> All Orders ({{ $serviceReviews->count() }})</small></h3>
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
                                <th>Service Name</th>
                                <th>Reviews By</th>
                                <th>Rating</th>
                                <th>Reviews</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($serviceReviews as $review)
                                <tr>
                                    <th>
                                        {{ $review->id }}
                                    </th>
                                    <th>
                                      <a href="{{ route('admin.service.order.edit', ['id' => $review->order_service_id]) }}">{{ $review->service->name }}</a>
                                    </th>
                                    <th>
                                        {{ $review->users->first_name }} {{ $review->users->last_name }}
                                    </th>
                                    <th>
                                        {{ $review->stars }}
                                    </th>
                                    <th>
                                        {{ $review->review }}
                                    </th>
                                    <th>
                                        {{ $review->created_at }}
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Reviews By</th>
                                <th>Rating</th>
                                <th>Reviews</th>
                                <th>Date</th>
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