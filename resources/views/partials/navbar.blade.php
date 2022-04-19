<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" ></a>
             <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" 
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                
                @guest
                    <form class="d-flex ms-auto">                        
                        <a type="button" class="btn btn-dark " href="{{ route('login') }}" >Login</a>
                        <a type="button" class="btn btn-dark " href="{{ route('register') }}">Register</a>
                    </form>
                @endguest

                @auth

                    <form method="POST" class="d-flex ms-auto" style="margin-right: 10px;">
                        @csrf
    
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">                     
                        
                    </form>

                    <form action="POST" action="{{ route('logout') }}" style="margin-right: 90px;">
                        @csrf
                        <div class="dropdown ">
                            <a class="btn btn-dark dropdown-toggle" type="button" id="userprofile" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-square"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userprofile">
                              <li><a class="dropdown-item" href="#">Account Settings</a></li>
                              <li><a class="dropdown-item" href="#">Change Password</a></li>
                              <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
                            </ul>
                        </div>
                    </form>

                    

                    {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link> --}}
                    </form>
                @endauth
                
            </div>
        </div>
    </nav>

</div>