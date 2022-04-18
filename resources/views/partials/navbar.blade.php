<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">YNS</a>
             <!-- Toggle button -->
            <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                
                @guest
                    <form class="d-flex ms-auto">                        
                        <a type="button" class="btn btn-dark " href="{{ route('login') }}" >Login</a>
                        <a type="button" class="btn btn-dark " href="{{ route('register') }}">Register</a>
                    </form>
                @endguest

                @auth

                    <form class="d-flex ms-auto">
                        @csrf
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-50">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                        </ul>

                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>

                        
                        
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                    </form>
                @endauth
                
            </div>
        </div>
    </nav>

</div>