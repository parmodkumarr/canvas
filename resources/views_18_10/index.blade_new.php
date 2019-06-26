<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ asset('public/css/fontastic.css') }}">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- Bootstrap Css -->
    <!-- <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css')}}"> -->
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('public/css/custom.css')}}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Dashboard</h1>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" class="form-validate">
                    <div class="form-group">
                      <input id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                      <label for="login-username" class="label-material">User Name</label>
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div><a id="login" href="index.html" class="btn btn-primary">Login</a>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form><a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="{{ route('register') }}" class="signup">Register</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/js/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{ asset('public/js/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- Main File-->
    <script src="{{ asset('public/js/front.js')}}"></script>
 
    <!-- Scripts -->
    @stack('script-footer')
</body>
</html>
