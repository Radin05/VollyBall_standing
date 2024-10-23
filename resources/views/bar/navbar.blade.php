<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        </div>
        <div class="navbar-menu-wrapper d-flex align-items-rifht justify-content-rifht">
            <ul class="navbar-nav m-auto">
                <li class="nav-item mx-2 mt-2">
                    <b>
                        <a href=""  class="text-secondary mb-3">Dashboard</a>
                    </b>
                </li>
                <li class="nav-item mt-2">
                    <b>
                        <a href="{{ route('tim.index') }}"  class="text-dribbble mb-3">Putri</a>
                    </b>
                </li>
                <li class="nav-item mt-2">
                    <b>
                        <a href="{{ route('team.index') }}"  class="text-primary mb-3">Putra</a>
                    </b>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
