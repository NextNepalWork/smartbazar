@extends('layouts.app')
@section('title', 'Login')

@section('content')
<section class="registerpage-container  vendor-registerpage-container">
    <div class="container">


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

                <div class="text-center py-3">
                <h4 class="center">Have No Account ? <a href="{{ route('register') }}" style="color: #ed1b2f;">Sign Up</a></h4>
            </div>
            </div>
            <div class="input-cart col-md-6 ">

                    <!--<div class=" text-center pt-3">-->
                    <!--              <h3 class="text-white">Login</h3>-->
                    <!--     </div>-->

                <!--login form-->
                <div class=" login login-form py-5">
                    <form  action="{{route('login')}}" method="post" autocomplete="off">
                        {{csrf_field()}}
                        <div class="uk-margin {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input class="uk-input" type="email" name="email" value="{{ old('email') }}" required="required" placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="uk-margin {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name="password" required="required" placeholder="Password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <label class="remember-checkbox text-muted">
                                    <input class="uk-checkbox mr-2  " type="checkbox" name="remember">Remember me
                                </label>
                            </div>
                            <button type="submit" name="login" class="uk-button view-cart ">Log in</button>

                        </div>
                    </form>
                    <a href="{{ url('/password/reset') }}" class="forgotpassword center uk-margin-top ">forgot
                        password?</a>

                    <div class="social-login center ">
                        <p class="log-or text-white center py-3">OR</p>
                        <div class="social-login-buttons  d-flex flex-wrap justify-content-center">
                            <a class="facebook" href="{{ url('/login/facebook') }}" style="color: #fff;padding: 10px 15px;background: #4267b2;margin: 10px;cursor: pointer;">
                                <i class="fab fa-facebook-f mr-2">   </i>Login with Facebook
                            </a>

                            <a class="google-plus" href="{{ url('/login/google') }}" style="background: #d34836;color: #fff;padding: 10px 15px;margin: 10px;cursor: pointer;">
                                <i class="fab fa-google-plus-g mr-2"></i>Login with Google+
                            </a>
                        </div>
                    </div>
                </div>



            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</section>
@endsection
