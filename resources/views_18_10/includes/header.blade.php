<nav class="navbar">
    <!-- Search Box-->
    <div class="search-box">
        <button class="dismiss"><i class="icon-close"></i></button>
        <form id="searchForm" action="#" role="search">
            <input type="search" placeholder="What are you looking for..." class="form-control">
        </form>
    </div>
    <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
                <!-- Navbar Brand -->
                <a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                    <div class="brand-text d-none d-lg-inline-block"><strong>Charts</strong></div>
                    <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                </a>
                <!-- Toggle Button-->
                <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                     
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
                             
                <!-- Logout    -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


    