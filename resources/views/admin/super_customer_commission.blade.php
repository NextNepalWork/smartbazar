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
                            <h2>Set Super Customer Commissions</h2>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Set Commssion Rate(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supercustomer as $key=> $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$value->user_name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>
                                            <form method="post" action="{{route('admin.vendor.SuperCustomer_commissions')}}" class="form-group">
                                                {{csrf_field()}}
                                                <input type="hidden" name="user_id" value="{{$value->id}}">
                                                <div class="row">
                                                    <input type="number" class="form-control"
                                                           value="{{\App\Model\SuperCustomerCommissionRate::where('user_id',$value->id)->first()?\App\Model\SuperCustomerCommissionRate::where('user_id',$value->id)->first()->commission_rate:''}}"  name="supercustomer_commission_rate">
                                                    <button type="submit" class="btn btn-success btn-sm">Set</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Set Commssion Rate(%)</th>
                                </tr>
                                </tfoot>
                            </table>
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