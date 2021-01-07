@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="content-box content-box--shadow">
                <div class="panel panel-default no-border-shadow">
                    <div id="ar-right-1">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="warning">
                                        <td class="text-left">Product Name</td>
                                        <td class="text-left">Image</td>
                                        <td class="text-right">Quantity</td>
                                        <td class="text-right">Unit Price</td>
                                        <td class="text-right">Total</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection