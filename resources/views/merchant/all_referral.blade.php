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
                <li>Vendor Request has been sent</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Dashboard</h3>
        </div>
        <!-- /.col-lg-12-->
    </div>
    <!-- /.row-->
    <div class="content__box content__box--shadow">
        <div class="row">
            <div class="input-cart col-md-12 ">
                <h2>Referred Vendors</h2>
                <table id="example" class="table table-striped table-bordered" >
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Account Status</th>
                        <th>Store Name</th>
                        <th>Email</th>
                        <th>Referral Status</th>
                        <th>Referral date</th>
                        <th>Total Commission</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($superReferral as $value)
                        <tr>
                            <td>{{$value->referrals->user_name}}</td>
                            <td>
                                @if($value->referrals->verified==0)
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>
                                @else
                                    <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i> </a>

                                @endif
                            </td>
                            <td>{{$value->referrals->vendorDetails->name}}</td>
                            <td>{{$value->referrals->vendorDetails->primary_email}}</td>
                            <td>
                                @if($value->referrals->vendorDetails->verified==0)
                                    <a href="" class="btn btn-danger"><i class="fa fa-times"></i> </a>
                                @else
                                    <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i> </a>

                                @endif
                            </td>
                            <td>{{$value->created_at}}</td>
                            <td>
                                {{$value->referrals->vendorDetails->verified=='0'?'waiting for confirmation':getConfiguration('global_vendor_commission')?getConfiguration('global_vendor_commission'):'Please contact admin for commission'}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>User Name</th>
                        <th>User Account Status</th>
                        <th>Store Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Referral date</th>
                        <th>Total Commission</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <!-- /#page-wrapper-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endpush