@extends('index')

@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">User Algos
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row bg-white has-shadow">
			<table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Title</td>
              <td>Type</td>
              <td>Formula</td>
              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($algos as $interval)
            <tr>
                <td>{{$interval->id}}</td>
                <td>{{$interval->title}}</td>
                <td>{{$interval->operator_type}}</td>
                <td>{{$interval->formula}}</td>
                <td><a class="dropdown-item" href="{{ URL::to('algos/' . $interval->id . '/edit') }}">Edit </a></td>
                <td><a class="dropdown-item" href="{{ URL::to('algos/delete/' . $interval->id . '') }}">Delete </a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</section>
 

  <div class="container">
    <div class="row">
      <div class="" id="chart">

      </div>
    </div>
  </div>

@endsection

@push('script-footer')
    <script src="{{url('')}}/public/js/app.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
