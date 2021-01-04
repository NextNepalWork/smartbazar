@extends('layouts.app')
@section('title', 'Sell With Us')

@section('content')


    <section class="registerpage-container  vendor-registerpage-container">
        <div class="container box-shadow mb ">
            <section class="breadcrumbs py-3 ">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><span>Sell With Us</span></li>
                </ul>
            </section>
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
            <div class="row ">
                <div class="col-md-6 pt-2">
                    <div class="register-benefits ">
                        <h3>Welcome to seller center</h3>
                        <ol>
                            <li>
                                <div>Sign up store profile</div>
                            </li>
                            <li>
                                <div>Upload a product to start selling</div>
                            </li>
                        </ol>
                        <h5>Sell and promote wherein thousands of customers are purchasing every day.</h5>
                        <h5>It takes less than 30 seconds to become a Market Place seller.</h5>

                        <ul class="liststyle--none">
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>List your Product</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Earn significant</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Sell across GCC</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Low fees</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Support and Education</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Ship with comfort</li>
                        </ul>
                    </div>
                </div>
                <div class="input-cart col-md-6 ">
                    <!--signup form for vendor-->
                    <form action="{{route('sell.post')}}" name="signup" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class=" signup vendorsignup">
                            <div class="sign-up-form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title_register">
                                            <h3>Register Your Store</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                <input class="uk-input" name="name" value="{{old('name')}}" type="text" required="required"
                                                       placeholder="Store name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                <input class="uk-input" name="type" value="{{old('type')}}" type="text" required="required"
                                                       placeholder="Store Type (eg. Fashion Store)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                                <input class="uk-input" name="email" type="email" required="required"
                                                       value="{{old('email')}}"  placeholder="Enter email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            {{-- <label class="uk-form-label" for="form-stacked-select">Phone number</label> --}}
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: phone"></span>
                                                <input class="uk-input" value="{{old('phone')}}" name="phone" type="text" required="required" value="{{ $user->phone }}" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: location"></span>
                                                <input class="uk-input" name="address" value="{{old('address')}}" type="text" required="required"
                                                       placeholder="Address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="button" class="uk-button view-cart pull-right" id="vendor-continue">Continue <span uk-icon="arrow-right"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- registration detail form-->
                        <div class="detailForm">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Pan number</label>

                                        <div class="uk-inline uk-width-1-1">
                                            <input class="uk-input" name="pan_number" value="{{old('pan_number')}}" type="text" required="required" placeholder="Pan Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Tax Clearance No.</label>

                                        <div class="uk-inline uk-width-1-1">
                                            <input class="uk-input" name="tax_clearance" type="text" value="{{old('tax_clearance')}}" required="required" placeholder="Tax Clearance">
                                        </div>
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
                                   <div class="col-sm-12">
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-stacked-select">Company Profile Picture
                                            *</label>

                                        <input type="file" name="profile_picture" class="form-control"
                                               placeholder="@Your Shop Image" value=""/>
                                    </div>
                                </div>
                                <div class="legal">
                                    <p class="grey-text policy"> <input class="uk-checkbox" type="checkbox" checked>I agree on our <a href="#!">Privacy
                                            Policy</a> and
                                        <a href="#!">Terms of Use</a> including <a href="#!">Cookie Use</a>.</p>
                                </div>
                                <div class="col-sm-12">
                                    <a href="javascript:void(0)" class="returning-vendor float-left">
                                        <span uk-icon="arrow-left"></span>back</a>
                                    <button type="submit" class="uk-button view-cart float-right">Submit</button>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
@endsection