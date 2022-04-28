@extends('partials.layout')



@section('content')
    
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md">
            @include('partials.sidebar')
        </div>

        {{-- Search Result --}}

        <div class="col-md-6">

            {{-- Flash messages --}}
            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <form action="/search/user" method="GET" >
                @csrf

                <div class="mb-3">
                    <input type="search" name="searchUser" class="form-control" placeholder="Search name..." aria-label="Search">
                </div>                     
                
            </form>

            <h1 class="display-6">Search result...</h1>

            @foreach ($users as $user)                 
                    <div class="card mb-3" style="max-width: 550px;">
                        <div class="row g-0" style="margin-top: 0;">
                            <div class="col-md-4">
                                <img src="{{ asset('images/' . $user->image_path) }}" class="img-thumbnail " >
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $user->first_name . ' ' . $user->last_name }}</h3>
                                    <p class="text-muted"> Date Joined: {{ date("F j, Y", strtotime( $user->created_at)) }}</p>
                                    <button class="btn btn-primary btn-sm">View Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                                    
            @endforeach  
        </div>
        {{-- Followers --}}
        <div class="col-md">           
            <div class="container">
            <div class="row ">
                <div class="col">
                    {{-- <div class="card text-white bg-primary" >
                        <div class="card-header">Follow other People</div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}  
                            <a type="button" class="btn btn-primary btn-sm " href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        <li class="list-group-item">Monkey D. Luffy
                            <a type="button" class="btn btn-primary btn-sm" href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        <li class="list-group-item">Roronoa Zoro
                            <a type="button" class="btn btn-primary btn-sm" href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            </div>          
        </div>
        {{-- Followers --}}
    </div>
</div>
    
@endsection