<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">YNS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                {{-- <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul> --}}

                <form class="d-flex ms-auto">
                    {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button> --}}
                    
                    <a type="button" class="btn btn-dark " href="{{ route('login') }}" >Login</a>
                    <a type="button" class="btn btn-dark " >Register</a>
                </form>
            </div>
        </div>
    </nav>
</div>