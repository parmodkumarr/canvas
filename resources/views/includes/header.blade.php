<script>
$(document).ready(function(){
  $(".mob-menu").click(function(){
    $(".set-nav li").removeClass('active');
    $(".list-unstyled").removeClass('show');
    $(".set-nav").slideToggle();
  });
  $(window).click(function(){
    
    $(".list-unstyled").removeClass('show');
    
  });
});
</script>
<nav class="navbar">
    <!-- Search Box-->
    <div class="search-box">
        <button class="dismiss"><i class="icon-close"></i></button>
        <form id="searchForm" action="#" role="search">
            <input type="search" placeholder="What are you looking for..." class="form-control">
        </form>
    </div>
    <div class="container-fluid">
        <div class="navbar-holder nav-set">
            <!-- Navbar Header-->
           <a class="top-logo" href=""><img src="{{ asset('public/front/images/logo.svg') }}" alt="logo"/></a>
		    <!-- Sidebar Navidation Menus-->
  <div class="new-nav"><span class="mob-menu"><i></i><i></i><i></i></span><ul class="list-unstyled set-nav">
       
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
            <ul class="nav-menu list-unstyled mtop">
                                     
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li class="disabled">
                            <a class="dropdown-item"><strong> {{ Auth::user()->name }} </strong></a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item"> Edit Profile</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item"> Change password</a>
                        </li>
						    
                    </ul>
                </li>
                         
            </ul>
			 <div class="side-button d-none-mob mtop">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();" class="button-logout logout"> Logout
                    </a>
					 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                <a class="download" href="{{ url('downloads') }}">download</a>
            </div>
			</div>
        </div>
    </div>
</nav>


    