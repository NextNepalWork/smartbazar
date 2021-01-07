@extends('admin.layouts.app')
@section('title', 'Edit Shipping Amount')

@section('content')
    @include('partials.message-success')
    @include('partials.message-error')

    <section>
        <div class="row">
            <h3>Edit Shipping Amount</h3>
            <div class="col-sm-12">
                <form action="{{ route('admin.shipping_amount.update') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $shipping_amount->id }}">
                    <div class="content__box content__box--shadow">
                        <div class="form-group {{ $errors->has('place') ? 'has-error' : '' }}">
                            <label for="place">Place</label>
                            <input type="text" name="place" class="form-control" value="{{ $shipping_amount->place }}">
                            @if ($errors->has('place'))
                                <span class="help-block">
                                    {{ $errors->first('place') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control" value="{{ $shipping_amount->amount }}">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    {{ $errors->first('amount') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-xs">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection