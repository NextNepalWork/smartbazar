@extends('layouts.app')
@section('title')
    Register
@endsection

@section('content')
    <section class="registerpage-container  vendor-registerpage-container">
        <div class="container">
            <section class="row breadcrumbs max-inner">
                <div class="columns col-12">
                    <ul class="breadcrumb-list">

                    </ul>
                </div>
            </section>

            <div class="row">
                <div class="col-md-6 py-3">
                    <div class="register-benefits">
                        <h3>Sign up today and you will be able to :</h3>
                        <p style="padding: 10px 0;">{{ getConfiguration('site_title') }} Protection has you covered from click to delivery. Sign up or sign in and you will
                            be able to:</p>
                        <ul class="liststyle--none">
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Speed your way through
                                checkout
                            </li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Track your orders easily</li>
                            <li><span class="uk-margin-small-right" uk-icon="check"></span>Keep a record of all your
                                purchases
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <h4 class="center">Already Have Account ? <a href="{{ route('login') }}" style="color: #ed1b2f;">Sign In</a></h4>
                </div>
                </div>
                <div class="input-cart col-md-6 ">
                    <!--forgotpassowrd form-->
                    <!--<div class=" forgotpassowrd-form">-->
                    <!--    <form action="" method="post" autocomplete="off">-->
                    <!--        <div class="uk-margin">-->
                    <!--            <div class="uk-inline uk-width-1-1">-->
                    <!--                <span class="uk-form-icon" uk-icon="icon: mail"></span>-->
                    <!--                <input class="uk-input" type="email" required="required"-->
                    <!--                       placeholder="Enter your email address">-->
                    <!--            </div>-->
                    <!--        </div>-->
                            <!--<button type="submit" class="uk-button pull-right">submit</button>-->
                    <!--    </form>-->
                    <!--    <div class="clearfix"></div>-->
                        <!--<a href="javascript:void(0)" class="returning-customer"><span class="uk-margin-small-right"-->
                        <!--                                                              uk-icon="arrow-left"></span>back-->
                        <!--    to sign in</a>-->
                    <!--</div>-->

                    <!--signup form-->
                    <div class=" signup">
                        <div class="py-5">
                            <form action="{{route('register')}}" class="uk-grid-small"  name="signup" method="post" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                <input class="uk-input" name="user_name"  value="{{ old('user_name') }}" type="text" required="required"
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
                                                <span class="uk-form-icon"  uk-icon="icon: mail"></span>
                                                <input class="uk-input" name="email" value="{{ old('email') }}" type="email" required="required"
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
                                                <input class="uk-input" name="password_confirmation" type="password" required="required"
                                                       placeholder="Confirm password">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-1">
                                                <span class="uk-form-icon" uk-icon="icon: phone"></span>
                                                <input class="uk-input" name="phone" type="text" value="{{ old('phone') }}" required="required" max="10" min="8"
                                                       placeholder="Enter Phone Number">
                                            </div>
                                            @if ($errors->has('phone'))
                                                <span class="help-block register-error">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="uk-margin">
                                            <div class="uk-inline uk-width-1-2@s">
                                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                <input class="uk-input" name="age" type="number" value="{{ old('age') }}" required="required" max="100" min="8"
                                                       placeholder="Enter Your Age">
                                            </div>
                                          
                                            <div class="uk-inline uk-width-1-3@s">
                                                <select class="uk-select" id="form-horizontal-select" name="sex">
                                                    <option value="">Select Sex</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('sex'))
                                            <div class="help-block register-error">
                                                <strong>{{ $errors->first('sex') }}</strong>
                                            </div>
                                             @endif
                                             @if ($errors->has('age'))
                                            <div class="help-block register-error">
                                                <strong>{{ $errors->first('age') }}</strong>
                                            </div>
                                             @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="uk-button view-cart float-right ">Sign Up</button>
                                    </div>
                                </div>

                            </form>


                        </div>


                    </div>

                </div>
                <div class="clearfix"></div>
                
            </div>
        </div>
    </section>
@endsection
