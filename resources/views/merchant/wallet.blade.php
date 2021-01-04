@extends('merchant.layouts.app')

@section('title',"Dashboard")

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
    <div class="row">
        <div class="col-lg-6">
            <h3 class="page-header">Dashboard</h3>
        </div>
        <!-- /.col-lg-12-->
    </div>
    <!-- /.row-->
    <div class="row">

        <div class="col-md-4">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Sn</th>
                    <th>Total Amount</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Your Wallet</td>
                    <td>{{$wallet->total_amount}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Sn</th>
                    <th>Total Amount</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="content__box content__box--shadow">
        <div class="row">
            <div class="input-cart col-md-12 ">
                <h2>Latest Referrals</h2>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Ordered User Name</th>
                        <th>Referred Product</th>
                        <th>Referral Status</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transaction as $key=> $value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->orders->user->user_name}}</td>
                            <td>{{$value->orders->products->first()->name}}</td>
                            <td>
                                @if($value->status==2)
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> </a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>

                                @endif
                            </td>
                            <td>{{$value->amount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sn</th>
                        <th>Order Name</th>
                        <th>Referred Product</th>
                        <th>Referral Status</th>
                        <th>Amount</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endpush