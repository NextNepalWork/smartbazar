@extends('admin.layouts.app')
@section('title', 'Vendor Requests')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        @include('partials.message-success')
                        <div class="input-cart col-md-12 ">
                            <h2>Set Super Vendor Commissions</h2>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Shop Description</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Set Commssion Rate(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($super as $key=> $value)
                                {{$value->vendorDetails}}
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Shop Description</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Set Commssion Rate</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @include('partials.message-success')
                        <div class="input-cart col-md-12 ">
                            <h2>Set Super Vendor Global Referral Commissions</h2>

                            <form action="{{route('admin.vendor.global-commission')}}" method="post" class="form-group">
                                {{csrf_field()}}
                                <label>Set Global Amount</label>
                                <input class="form-control" type="text"
                                       value="{{ getConfiguration('global_vendor_commission') ? getConfiguration('global_vendor_commission') : '' }} "
                                       name="global_vendor_commission">
                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endpush