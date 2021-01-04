@extends('merchant.layouts.app')

@section('title',"Withdraw")

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">
			<strong>Success: </strong>{{ Session::get('success') }}
		</div>
	@endif
	@if(count($errors) > 0)
		@foreach($errors->all() as $error)
			{{ $error }}
		@endforeach
	@endif

	<div style="margin-top: 20px;">
		<div style="display: flex;justify-content: space-between;align-items: center;">
			<h1>Withdraw Form</h1>
			<a href="{{ route('vendor.withdraw.account') }}" class="btn btn-danger btn-sm">Back</a>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
				<form action="{{ route('vendor.withdraw.store') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="approve" value="0">
					<div class="form-group">
						<label for="">Withdraw Method*</label>
						<input type="text" name="method" class="form-control" placeholder="Enter Your Bank Name" value="{{ isset($bankInfo) ? $bankInfo->bank_name:'' }}">
					</div>
					<div class="form-group">
						<label for="">Withdraw Amount*</label>
						<div class="input-group">
					      <div class="input-group-addon">Rs.</div>
					      <input type="text" class="form-control" name="amount" placeholder="Withdraw amount" value="{!! old('amount') !!}">
					      <div class="input-group-addon">.00</div>
					    </div>
					</div>
					<div class="form-group">
						<label for="">email*</label>
						<input type="email" class="form-control" name="email" placeholder="Account email address" value="{!! old('email') !!}">
					</div>
					<div class="form-group">
						<label for="">Account no.*</label>
						<input type="text" class="form-control" name="account_no" placeholder="Account number" value="{{ isset($bankInfo) ? $bankInfo->account_number:'' }}">
					</div>
					<div class="form-group">
						<label for="">Account Name*</label>
						<input type="text" class="form-control" name="account_name" placeholder="Account name" value="{{ isset($bankInfo) ? $bankInfo->account_holder:'' }}">
					</div>
					<div class="form-group">
						<label for="">Account Address*</label>
						<input type="text" class="form-control" name="account_address" placeholder="Account address" value="{!! old('account_address') !!}">
					</div>
					<div class="form-group">
						<label for="">Additional Reference</label>
						<textarea name="reference" cols="30" rows="10" class="form-control" placeholder="Additional Reference (Optional)" value="{!! old('reference') !!}"></textarea>
					</div>

					<input type="submit" name="submit" value="Withdraw Now" class="btn btn-primary btn-block">
				</form>
			</div>
		</div>
	</div>
@endsection