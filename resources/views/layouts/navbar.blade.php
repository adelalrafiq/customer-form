

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <h2>Logo</h2>
       
            <ul class="navbar-nav ml-auto">

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('form') }}">
                        <div class="navbar-icon">
                            <i class="fas fa-align-center"></i>                           
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <div class="navbar-icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="navbar-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>                        
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>       
    </div>
</nav>