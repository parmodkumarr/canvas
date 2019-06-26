@extends('index')

@section('content')

    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">{{ $workchart->title }}
        </div>
    </header>

     <section class="forms"> 
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6">
                    
                    <div class="card">
                        <!-- will be used to show any messages -->
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        <!-- will be used to show any error from Validator -->
                        @if($errors->count())
                          <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
                        @endif
                        <div class="card-body">
                            <p>
                                <a href="{{ URL::to('workcharts/' . $workchart->id . '/create') }}" class="btn btn-primary">Add to workchart</a>
                                <a href="{{ URL::to('workcharts/' . $workchart->id . '/edit') }}" class="btn btn-primary pull-right">Edit workchart</a>
                                <div class="clearfix"></div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
