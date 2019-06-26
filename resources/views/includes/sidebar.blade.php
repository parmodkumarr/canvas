<nav class="side-navbar" style="display:none;">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>

        <div class="title">
          <h1 class="h4">Admin</h1>
        </div>
    </div>
    <!-- Sidebar Navidation Menus-->
   <ul class="list-unstyled">
       
       <li class="{{checkActivePage('workcharts',1)}} {{checkActivePage('charts',1)}}">
           <a href="#workchartdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Workcharts </a>
           <ul id="workchartdropdownDropdown" class="collapse list-unstyled ">
               <li><a href="{{ URL::to('/workcharts/create') }}">Add workchart</a></li>
               <li><a href="{{ route('workcharts') }}">All workcharts</a></li>
           </ul>
       </li>
       <li class="{{checkActivePage('intervals',1)}} ">
           <a href="#intervaldropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>User Indicator</a>
           <ul id="intervaldropdownDropdown" class="collapse list-unstyled ">
               <li><a href="{{ URL::to('/intervals/create') }}">Add Indicator</a></li>
               <li><a href="{{ route('intervals') }}">All User Indicators</a></li>
           </ul>
       </li>
       <li class="{{checkActivePage('algos',1)}} ">
           <a href="#algosdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>User Algos </a>
           <ul id="algosdropdownDropdown" class="collapse list-unstyled ">
               <li><a href="{{ URL::to('/algos/create') }}">Add Algo</a></li>
               <li><a href="{{ route('algos') }}">All Algos</a></li>
           </ul>
       </li>
   </ul>
</nav>