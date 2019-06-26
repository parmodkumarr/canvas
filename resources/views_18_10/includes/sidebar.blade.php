<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h4">Admin</h1>
        </div>
    </div>
    <!-- Sidebar Navidation Menus-->
    <ul class="list-unstyled">
        <li class="{{checkActivePage('home',1)}}"><a href="{{ url('home') }}"> <i class="icon-home"></i>Home </a></li>
        <li class="{{checkActivePage('workcharts',1)}} {{checkActivePage('charts',1)}}">
            <a href="#workchartdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Workcharts </a>
            <ul id="workchartdropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{ URL::to('/workcharts/create') }}">Add workchart</a></li>
                <li><a href="{{ route('workcharts') }}">All workcharts</a></li>
            </ul>
        </li>
    </ul>
</nav>