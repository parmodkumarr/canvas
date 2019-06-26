@extends('frontal3')

@section('content')


<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow login-form">
                    <div class="form">
					<h6>login With Email</h6>
                        <div class="content">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {!! csrf_field() !!}
                                
                                @if(Session::has('error'))
                                    <div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>Warning!</strong> {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    
                                    <label for="email" class="label-material active">Email</label><input id="email" type="email" name="email" required="" data-msg="Please enter your email" class="input-material is-valid" aria-invalid="false" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                   
                                    <label for="password" class="label-material active">Password</label> <input id="password" type="password" name="password" required="" data-msg="Please enter your password" class="input-material is-valid" aria-invalid="false">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
<div class="remember-set">
                                <label class="pull-left checkbox-inline"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1" id="remember">
                                    <small><label for="remember">Remember Me</label></small>
                                </label>

                                <a href="{{ route('password.request') }}" class="forgot-pass">
                                    Forgot your password?                                    
                                </a>
</div>
                                <div class="clearfix"></div>
                                <button id="login" type="submit" class="btn btn-primary">Login</button>
                            </form>
                            <div class="have-account"><small>Do not have an account? </small>
                            <a href="{{ route('register') }}" class="signup">Register</a>
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
