{{-- <div class="content__box content__boxshadow"> --}}
	<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
		{{-- <div class="col-xs-6"> --}}
			{!! Form::label('name', 'Name *', ['class' => 'control-label']) !!}
		{{-- </div>
		<div class="col-xs-10"> --}}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your Deal...']) !!}

			@if ($errors->has('name'))
		        <span class="help-block">
		            {{ $errors->first('name') }}
		        </span>
			@endif
	</div>
	{{-- <div class="form-group">
		<label for="">Add Time</label>
		<input type="text" name="time" class="form-control" placeholder="Add Time">
	</div> --}}
	<div class="form-group {{ ($errors->has('end_date')) ? 'has-error' : '' }}">
			<label for="end_date" class="control-label">End Date </label>
			<span class="text-danger"> * </span><br>
			<input name="end_date" type="date" value="{{ isset($deals->end_date) ? $deals->end_date : '' }}" id="end_date">
			@if ($errors->has('end_date'))
		        <span class="help-block">
		            {{ $errors->first('end_date') }}
		        </span>
			@endif
    </div>
	{{-- </div> --}}
	{!! Form::submit($submitButtonText, ['class'=>'btn btn-success btn-sm']) !!}
{{-- </div> --}}