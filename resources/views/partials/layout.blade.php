<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Blog</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

        {{-- Bootstrap Core CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        {{-- Custom CSS --}}
        <link rel="stylesheet" href="{{asset('assets/css/customcss.css')}}">


    </head>
    <body>

        @include('partials.navbar');


        <div class="main-content">
        
            @yield('content')

        </div>

        
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
        crossorigin="anonymous"></script>

        <script type="text/javascript" src="{{asset('assets/js/customjs.js')}}"></script>
        
        @if (Session::has('errors'))
          <script type="text/javascript" src="{{asset('assets/js/openmodal.js')}}"></script>
        @endif

        @if ($errors->has('updateComment'))
          <script type="text/javascript" src="{{asset('assets/js/updatecomment.js')}}"></script>
        @endif
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        @yield('scripts')

        {{-- <div class="container">
            <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-4 border-top">
              <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                  <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                </a>
                <span class="text-muted">© 2022 Microblog Laravel 9</span>
              </div>
            </footer>
        </div> --}}
    </body>
</html>