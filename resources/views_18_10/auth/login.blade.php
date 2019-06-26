@extends('layouts.app')

@section('content')


<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
            <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Login</h1>
                            </div>
                           <!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                        </div>
                    </div>
                </div>
                <!-- Form Panel -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" name="email" required="" data-msg="Please enter your email" class="input-material is-valid" aria-invalid="false" value="{{ old('email') }}" required autofocus>
                                    <label for="email" class="label-material active">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" name="password" required="" data-msg="Please enter your password" class="input-material is-valid" aria-invalid="false">
                                    <label for="password" class="label-material active">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="pull-left checkbox-inline"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1" id="remember">
                                    <small><label for="remember">Remember Me</label></small>
                                </label>

                                <a href="{{ route('password.request') }}" class="forgot-pass">
                                    Forgot your password?                                    
                                </a>

                                <div class="clearfix"></div>
                                <button id="login" type="submit" class="btn btn-primary">Login</button>
                            </form>
                            <small>Do not have an account? </small>
                            <a href="{{ route('register') }}" class="signup">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        /*$(document).ready(function(){
            $( "#login_form" ).validate({
                rules: {
                    identity: {
                        required: true,
                        email: true
                    },
                    password:{
                        required: true
                    }
                }
            });
        });*/
    </script>
    </div>
</div>

@endsection
