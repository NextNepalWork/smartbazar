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
                            <h2>Super Vendor Referrals</h2>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Super Vendor Name</th>
                                    <th>Email</th>
                                    <th>Total Vendor Referral</th>
                                    <th>Total Referral from store</th>
                                    <th>Wallet</th>
                                    <th>Payment</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supervendor as $key=> $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$value->user_name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{count($value->referrals) }}</td>
                                        <td>
                                          @php
                                            if ($value->storeReferrals->isnotEmpty()){
                                             foreach ( $value->storeReferrals as $amount){
                                                $total[]=$amount->amount;
                                                }
                                                
                                                
                                            $amount_total= array_sum($total);
                                            }
                                            else{
                                            $amount_total=0;
                                            }
                                               
                                            @endphp
                                            
                                            
                                            {{$amount_total}}

                                        </td>
                                        <td>{{$value->SuperWallet->first()->total_amount}}</td>
                                        <td>
                                            <div class="row">
                                                <form method="post" action="{{route('admin.vendor.referrals')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="super_vendor_id"
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
                                    <th>Super Vendor Name</th>
                                    <th>Email</th>
                                    <th>Total Vendor Referral</th>
                                    <th>Total Referral from store</th>
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