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
        <div class="col-lg-12">
            <h3 class="page-header">Dashboard</h3>
        </div>
        <!-- /.col-lg-12-->
    </div>
    <div class="content__box content__box--shadow">
        <div class="row">
            <div class="input-cart col-md-12 table-responsive">
                <h2>Referrable Products</h2>
                <table id="example-1" class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>View</th>
                        <th>Product Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($referrableProduct as $key=> $product)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$product->name}}</td>
                            <td><a target="_blank" href="{{route('product.show',$product->slug)}}" class="btn btn-info"><i class="fa fa-eye"></i> </a> </td>
                            <td>{{url('product/'.$product->slug)}} </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>View</th>
                        <th>Product Link</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>    <!-- /#page-wrapper-->

    <!-- /.row-->
    <div class="content__box content__box--shadow">
        <div class="row">

            <div class="col-md-12">
                <form class="form-group" action="{{route('vendor.referral_link')}}" method="post">
                    {{csrf_field()}}
                    <label>Generate Referral Link</label>
                    <small>(Copy Product link and Paste)</small>
                    <input class="form-control" name="referral_link">
                    <button class="btn btn-success btn-sm">Generate Link</button>

                </form>
            </div>
        </div>
    </div>
    <div class="content__box content__box--shadow">
        <div class="row">
            <div class="input-cart col-md-12 table-responsive">
                <h2>Generated Links</h2>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Refer Link</th>
                        <th>Product Link</th>
                        <th>Token</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($created_links as $key=>$value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->refer_link}}</td>
                            <td>{{$value->product_link}}</td>
                            <td>{{$value->token}}</td>
                            <td><a href="" class="btn btn-danger"><i class="fa fa-trash"></i> </a></td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Refer Link</th>
                        <th>Product Link</th>
                        <th>Token</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>    <!-- /#page-wrapper-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
            $('#example-1').DataTable();
        });
    </script>

@endpush