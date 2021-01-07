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


                <!--signup form for vendor-->
                <form action="{{route('vendor.add-vendor')}}" name="signup" method="post" autocomplete="off"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class=" signup vendorsignup">
                        <div class="sign-up-form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title_register">
                                        <h3>Create Vendor Credentials</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                                            <input class="uk-input" name="user_name" value="{{ old('user_name') }}"
                                                   type="text" required="required"
                                                   placeholder="Enter Username">
                                        </div>
                                        @if ($errors->has('user_name'))
                                            <span class="help-block register-error">
                                                    <strong>{{ $errors->first('user_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                            <input class="uk-input" name="email" value="{{ old('email') }}" type="email"
                                                   required="required"
                                                   placeholder="Enter Email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block register-error">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input" name="password" type="password" required="required"
                                                   placeholder="Enter password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block register-error">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input" name="password_confirmation" type="password"
                                                   required="required"
                                                   placeholder="Confirm password">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: phone"></span>
                                            <input class="uk-input" name="phone" type="text" value="{{ old('phone') }}"
                                                   required="required" max="10" min="8"
                                                   placeholder="Enter Phone Number">
                                        </div>
                                        @if ($errors->has('phone'))
                                            <span class="help-block register-error">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="title_register">
                                    <h3>Vendor Detail</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input" name="name" value="{{old('name')}}" type="text"
                                                   required="required"
                                                   placeholder="Store name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                            <input class="uk-input" name="type" type="text" value="{{old('type')}}"
                                                   required="required"
                                                   placeholder="Store Type (eg. Fashion Store)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                            <input class="uk-input" name="email" type="email" required="required"
                                                   placeholder="Enter email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        {{-- <label class="uk-form-label" for="form-stacked-select">Phone number</label> --}}
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: phone"></span>
                                            <input class="uk-input" name="phone" type="text" required="required"
                                                   value="{{old('phone')}}" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <div class="uk-inline uk-width-1-1">
                                            <span class="uk-form-icon" uk-icon="icon: location"></span>
                                            <input class="uk-input" name="address" type="text"
                                                   value=" {{old('address')}}" required="required"
                                                   placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Pan number</label>

                                        <div class="uk-inline uk-width-1-1">
                                            <input class="uk-input" name="pan_number" value="{{old('pan_number')}}" type="text" required="required"
                                                   placeholder="Pan Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Tax Clearance No.</label>

                                        <div class="uk-inline uk-width-1-1">
                                            <input class="uk-input" name="tax_clearance" value="{{old('tax_clearance')}}" type="text" required="required"
                                                   placeholder="Tax Clearance">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select"> Pan No. Registration *</label>
                                        <!--<div class="uk-inline uk-width-1-1" uk-form-custom>-->
                                        <input type="file" name="pan_image" class="form-control" accept="image/*">
                                        <!--<button class="uk-button uk-button-default button-select" type="button" tabindex="-1">Select-->
                                        <!--</button>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                   <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Vendor Type</label>
<small>Standard(Rs 2000), Exclusive(Rs 5000)</small>
                                        <select name="vendor_type" class="form-control">
                                            <option value="standard">Standard</option>
                                            <option value="exclusive">Exclusive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select"> Company Image *</label>
                                        <!--<div class="uk-inline uk-width-1-1" uk-form-custom>-->
                                        <input type="file" name="company_image" class="form-control" accept="image/*">
                                        <!--<button class="uk-button uk-button-default button-select" type="button" tabindex="-1">Select-->
                                        <!--</button>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select"> Signature Image *</label>
                                        <!--<div class="uk-inline uk-width-1-1" uk-form-custom>-->
                                        <input type="file" class="form-control" name="signature_image" accept="image/*">
                                        <!--<button class="uk-button uk-button-default button-select" type="button" tabindex="-1">Select-->
                                        <!--</button>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="legal">
                                    <p class="grey-text policy"><input class="uk-checkbox" type="checkbox" checked>I
                                        agree on our <a href="#!">Privacy
                                            Policy</a> and
                                        <a href="#!">Terms of Use</a> including <a href="#!">Cookie Use</a>.</p>
                                </div>
                                <div class="col-sm-12">
                                    <a href="javascript:void(0)" class="returning-vendor float-left">
                                        <span uk-icon="arrow-left"></span>back</a>
                                    <button type="submit" class="uk-button btn-success float-right">Submit</button>
                                    <div class="clearfix"></div>
                                </div>


                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- /#page-wrapper-->
@endsection

@push('scripts')

@endpush