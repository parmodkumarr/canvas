@extends('index')

<!-- <div class="col-md-2 sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li><a href="/workcharts/create" class="">Add workchart</a></li>
    </ul>
</div> -->


@section('content')
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Create Workchart
        </div>
    </header>
    <section class="forms"> 
        <div class="container-fluid">
            <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-12">
                    
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
                            <h5>You can add a new workchart from here.</h5>
                            {{ Form::open(array('url' => 'workcharts/create')) }}
                                <div class="form-group">
                                    
                                    {{ Form::label('title', 'Title') }}
                                    {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
                                  
                                </div>
                                
                                <div class="form-group">
                                    <a class="btn btn-default" href="{{  URL::to('workcharts') }}">Back</a>
                                    {{ Form::submit('Create the Workchart!', array('class' => 'btn btn-primary')) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

@endsection
