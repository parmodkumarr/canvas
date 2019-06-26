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
<!-- Bootstrap Css -->
<!-- <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css')}}"> -->
<!-- Google fonts - Poppins -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
<!-- Font Awesome CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{ asset('public/css/custom.css')}}">
<link rel="stylesheet" href="{{ asset('public/css/spectrum.css')}}">
<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>

