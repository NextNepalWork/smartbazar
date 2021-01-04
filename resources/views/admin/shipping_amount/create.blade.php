@extends('admin.layouts.app')
@section('title', 'Create Shipping Amount')

@section('content')
    @include('partials.message-success')
    @include('partials.message-error')

    <section>
        <div class="row">
            <h3>Create New Shipping Amount</h3>
            <div class="col-sm-12">
                <form action="{{ route('admin.shipping_amount.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content__box content__box--shadow">
                        <div class="form-group {{ $errors->has('place') ? 'has-error' : '' }}">
                            <label for="place">Place</label>
                            <input type="text" name="place" class="form-control">
                            @if ($errors->has('place'))
                                <span class="help-block">
                                    {{ $errors->first('place') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    {{ $errors->first('amount') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection