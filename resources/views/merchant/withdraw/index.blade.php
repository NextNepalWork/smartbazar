@extends('merchant.layouts.app')
@section('title',"Withdraw")
@section('content')
@if(Session::has('success'))
		<div class="alert alert-success">
			<strong>Success: </strong>{{ Session::get('success') }}
		</div>
	@endif
	@if(Session::has('error'))
		<div class="alert alert-danger">
			<strong>Error: </strong>{{ Session::get('error') }}
		</div>
	@endif
	<section>
        <div class="content__box content__box--shadow">
            <div class="row">
                <h3>Balance Information</h3>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Total Sales Balance</div>
                            <div class="huge">Rs. {{ $total_balance }}</div>
                        </div>
                        <a href="{{ route('vendor.order.index' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Current Balance</div>
                            <div class="huge">Rs. {{ $total_balance - $total_withdraw }}</div>
                        </div>
                        <a href="{{ route('vendor.order.index' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Total Withdraw</div>
                            <div class="huge">Rs. {{ $total_withdraw }}</div>
                        </div>
                        <a href="{{ route('vendor.withdraw' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Last Withdraw</div>
                            <div class="huge">Rs. {{ $last_withdraw ? $last_withdraw->amount : 0 }}</div>
                        </div>
                        <a href="{{ route('vendor.withdraw' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Total Commission</div>
                            <div class="huge">Rs. {{ $total_commission > 0 ? $total_commission : 0 }}</div>
                        </div>
                        <a href="{{ route('vendor.withdraw' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Total VAT</div>
                            <div class="huge">Rs. {{ $tax > 0 ? $tax : 0 }}</div>
                        </div>
                        <a href="{{ route('vendor.withdraw' ) }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div style="margin-top: 20px;">
		<div style="display: flex;justify-content: space-between;align-items: center;">
			<h1>Withdraw Table</h1>
			<a href="{{ route('vendor.withdraw.account') }}" class="btn btn-primary btn-sm">Withdraw Now</a>
		</div>
        <div class="modal fade" id="quickViewModal" tabindex="-1"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover " id="withdraw-table">
						<thead>
							<tr>
								<th>S.N.</th>
								<th>Date</th>
								<th>Method</th>
								<th>Email</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($withdraws as $withdraw)
							<div style="display: none;">{{ $status = \App\Model\WithdrawStatus::where('id',$withdraw->status)->first()->status}}</div>
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $withdraw->created_at->diffForHumans() }}</td>
								<td>{{ $withdraw->method }}</td>
								<td>{{ $withdraw->email }}</td>
								<td>{{ number_format($withdraw->amount,2) }}</td>
								<td><span class="label label-{{ $status }}">{{ $status }}</span></td>
								<td>
									@if($withdraw->status==1)
										<form action="{{ route('vendor.withdraw.cancel',$withdraw->id) }}" id="cancel-withdraw-{{ $withdraw->id }}" method="get">
											{{ csrf_field() }}
										</form>
										<a href=""
										onclick="
					                    if(confirm('Are you sure! You want to cancel withdraw.'))
					                      {
					                        event.preventDefault();document.getElementById('cancel-withdraw-{{ $withdraw->id }}').submit();
					                      }
					                    else
					                      {
					                        event.preventDefault();
					                      }" 
					                    class="btn btn-xs btn-danger">Cancel</a>
									@endif
                                        <a href="javascript:void(0);" data-id="{{ $withdraw->id }}" class="btn btn-xs btn-info btn-edit1"><i class="fas fa-check"></i> View Details</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#withdraw-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 4},
                {"orderable": false, "targets": 5}
            ]
        });
    })


    var $modal = $('#quickViewModal');
    $(document).on("click", ".btn-edit1", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.attr('data-id');
        var viewDetails = "{{ route('vendor.withdraw.edit', ':id') }}";
        viewDetails = viewDetails.replace(':id', id);
        $modal.load(viewDetails, function (response) {
            $modal.modal({show: true});
        });
    });
</script>

@endpush