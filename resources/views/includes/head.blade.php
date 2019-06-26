<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<link href="{{ asset('public/css/app.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('public/css/style.default.css') }}" id="theme-stylesheet"/>
<link rel="stylesheet" href="{{ asset('public/css/fontastic.css') }}"/>
<link rel="stylesheet" href="{{ asset('public/js/bootstrap/css/bootstrap.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('public/css/custom.css')}}"/>
<link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}"/>
<link rel="stylesheet" href="{{ asset('public/css/spectrum.css')}}"/>
<style>
	.has-error {
	    border-color: #a94442;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	}
	.btn-sm, .btn-group-sm > .btn {
	  padding: 0.25rem 0.5rem;
	  font-size: 0.875rem;
	  line-height: 0.8;
	  border-radius: 0.1rem;
	}
</style>
<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
