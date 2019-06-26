@extends('frontal3')

@section('content')





<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow login-form">
                    <div class="form">
					<h6>Reset Password</h6>
					@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="content">
                            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                                
                                 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button id="reset-button" type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                        </div>
                            </form>
                        </div>
                    </div>
        </div>

    </div>
</div>
@endsection
