@extends('admin.layouts.app')
@section('title', 'Vendor Requests')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{\Illuminate\Support\Facades\Session::get('success')}}</li>
            </ul>
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        @include('partials.message-success')
                        <div class="input-cart col-md-12 ">
                            <h2>Super Customer Referrals</h2>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Super Customer Username</th>
                                    <th>Email</th>
                                    <th>Total Product Referral</th>
                                    <th>Wallet</th>
                                    <th>Payment</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supercustomer as $key=> $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$value->user_name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{count($value->superCustomer_referrals) }}</td>
                                        <td>{{$value->SuperCustomerWallet->first()->total_amount}}

                                        </td>
                                        <td>
                                            <div class="row">
                                                <form method="post" action="{{route('admin.vendor.SuperCustomer_referrals')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="super_customer_id"
                                                           value="{{$value->id}}">
                                                    <input type="number" name="payment" class="form-control">
                                                    <button class="btn btn-success btn btn-sm">Pay</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Super Customer Username</th>
                                    <th>Email</th>
                                    <th>Total Product Referral</th>
                                    <th>Wallet</th>
                                    <th>Payment</th>

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