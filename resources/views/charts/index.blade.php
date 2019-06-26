@extends('index')

@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Workcharts
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach ($workcharts as $workchart)
                        <div class="col-md-4">
                            <div class="thumbnail">
                                @if ($workchart->picture)
                                    <a href="{{ URL::to('workcharts/' . $workchart->id) }}"><img src="" alt=""></a>
                                @else
                                    <a href="{{ URL::to('workcharts/' . $workchart->id) }}"><img src="{{ asset('public/img/no_chart.png') }}" width="100%" alt=""></a>
                                @endif
                            </div>
                            <div class="caption">
                                <h4 style="height:60px;">
                                    <a href="{{ URL::to('workcharts/' . $workchart->id) }}">{{ str_limit($workchart->title,50) }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script-footer')
    <script src="{{url('')}}/public/js/app.js?v={{ rand(1000, 50000000) }}"></script>

@endpush
