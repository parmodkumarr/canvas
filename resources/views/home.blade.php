@extends('index')

@section('content')

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Dashboard</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
    <div class="row bg-white has-shadow">
        <h3 style="float:left; width:100%; text-align: center;">Welcome To Dashboard</h3>
    </div>
    </div>
</section>
@endsection

@push('script-footer')
    <script src="{{url('')}}/public/js/app.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
