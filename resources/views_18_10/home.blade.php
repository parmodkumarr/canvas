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
        <!--<div class="row bg-white has-shadow">
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>New<br>Clients</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number"><strong>25</strong></div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-red"><i class="icon-padnote"></i></div>
                <div class="title"><span>Work<br>Orders</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                  </div>
                </div>
                <div class="number"><strong>70</strong></div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-green"><i class="icon-bill"></i></div>
                <div class="title"><span>New<br>Invoices</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                  </div>
                </div>
                <div class="number"><strong>40</strong></div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-orange"><i class="icon-check"></i></div>
                <div class="title"><span>Open<br>Cases</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                  </div>
                </div>
                <div class="number"><strong>50</strong></div>
              </div>
            </div>
        </div>-->
    </div>
</section>
<!-- Dashboard Header Section    -->
<section class="dashboard-header">
    <div class="container-fluid">
        <div class="row">
        </div>
    </div>
</section>


@endsection

@push('script-footer')
    <script src="{{url('')}}/public/js/app.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
