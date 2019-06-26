@extends('index')

@section('sidebar')
  <div class="col-md-2 sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li><a href="/workcharts/create" class="">Add workchart</a></li>
    </ul>
  </div>
@endsection

@section('content')

  <div class="col-md-10 content">

    <div class="panel panel-default">

      <div class="panel-heading">{{ $workchart->title }}</div>

      <div class="panel-body">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <!-- will be used to show any error from Validator -->
        @if($errors->count())
          <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
        @endif

        <p>
          <a href="{{ URL::to('workcharts/' . $workchart->id . '/edit') }}" class="btn btn-primary">Add to workchart</a>
          <a href="{{ URL::to('workcharts/' . $workchart->id . '/edit') }}" class="btn btn-primary pull-right">Edit workchart</a>
          <div class="clearfix"></div>
        </p>



      </div>

    </div>

  </div>

@endsection
