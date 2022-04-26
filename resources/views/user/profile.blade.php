@extends('partials.layout')



@section('content')
    
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            @include('partials.sidebar')
        </div>

        {{-- User Profile --}}

        <div class="col-6">
           
            
            <div class="container">
                <a href="/profile/{{ Auth::user()->id }}/edit" value="{{ Auth::user()->id }}"type="button" class="btn btn-success float-end" >
                    <i class="bi bi-pencil-square"></i> Update Profile
                </a>
            </div>
            

             {{-- Flash messages --}}
            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <div class="card">
                <h5 class="card-header">My Profile</h5>
                <div class="card-body">
                    <h5>First Name: {{ Auth::user()->first_name }}</h5>
                    <hr>
                    <h5>Middle Name: {{ Auth::user()->middle_name }}</h5>
                    <hr>
                    <h5>Last Name: {{ Auth::user()->last_name }}</h5>
                    <hr>
                    <h5>Date of Birth: {{ date("F j, Y", strtotime( Auth::user()->date_of_birth)) }} </h5>
                    <hr>
                    <h5>Username: {{ Auth::user()->username }}</h5>
                    <hr>
                    <h5>Email: {{ Auth::user()->email }}</h5>
                    <hr>
                    <h5>Date Joined: {{ date("F j, Y", strtotime( Auth::user()->created_at)) }} </h5>
                    <hr>
                    <h5 for="description" c>Profile Image :</h5>
                    <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="img-fluid"> 
                    <hr>              
            
                </div>
            </div>
        </div>
        {{-- User Profile --}}
        

        {{-- Followers --}}
        <div class="col ">           
            <div class="container">
            <div class="row ">
                <div class="col">
                <div class="card text-white bg-primary" >
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
                </div>
                </div>
            </div>
            </div>          
        </div>
        {{-- Followers --}}
    </div>
</div>
    
@endsection