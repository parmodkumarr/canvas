
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes.head')
</head>

<body>
    @yield('content')
    <!-- JavaScript files-->
    <script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/js/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery-validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        	var page = window.location.href.split('/').pop();
        	//console.log(page);
            var timeout = ({{config('session.lifetime')}} * 60) * 1000;
            setTimeout(function() {
                //reload on current page
                window.location = '';
            }, timeout);
            
        })    
    </script>
</body>
</html>