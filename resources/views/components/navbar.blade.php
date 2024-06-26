<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNavbar">
    <a class="navbar-brand" href="#">
        <img src="/assets/Union.png" alt="Logo">
    </a>
    <div class="title-brand"><h3>Meta <span style="font-weight: bold">Blog</span></h3></div>

    <div class="mx-auto navbar-nav">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
        <a class="nav-link" href="#">Blog</a>
        <a class="nav-link" href="#">Team</a>
    </div>
    <div class="ml-auto navbar-right">
        @if (Route::has('login'))
            @auth
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="px-2 py-1 mr-2 text-white rounded-circle bg-secondary">
                            <i class="fas fa-user"></i>
                        </span>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->is_admin)
                            <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Sign in</a>
            @endauth
        @endif
    </div>
</nav>
