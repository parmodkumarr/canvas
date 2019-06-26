@extends('index')



@section('content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit Workchart
        </div>
    </header>
    <section class="forms"> 
        <div class="container-fluid">
            <div class="row">
                <!-- Basic Form-->
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
                            <p>You can add a new workchart from here.</p>
                            {{ Form::model($workchart, array('route' => array('workcharts.update', $workchart->id), 'method' => 'PUT')) }}
                                <div class="form-group">
                                    
                                    {{ Form::label('title', 'Title') }}
                                    {{ Form::text('title', null, array('class' => 'form-control')) }}
                                  
                                </div>
                                
                                <div class="form-group">
                                    <a class="btn btn-default" href="{{  URL::to('workcharts') }}">Back</a>
                                    {{ Form::submit('Edit the Workchart!', array('class' => 'btn btn-primary')) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
