@extends('partials.layout')



@section('content')
    
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md">
            @include('partials.sidebar')
        </div>

        {{-- User Change Password --}}

        <div class="col-md-6">
            {{-- Flash messages --}}
            @if (session()->has('message'))
            <div class="alert alert-primary" role="alert">
               {{ session()->get('message') }}
            </div>
            @elseif (session()->has('status'))
                <div class="alert alert-danger" role="alert">
                {{ session()->get('status') }}
                </div>
            @endif
     
            <h1 class="display-6 mt-5">Change Password</h1>
            <hr class="my-4">
            <p>Please check your email then enter your current and new password.</p>

            <form method="POST" action="{{ route('reset-password') }}">
                @csrf
                @method('PUT')

                {{-- <input type="hidden" name="reset_user_id" id="reset_user_id" value="{{ Auth::user()->id }}"> --}}

                <div class="input-group mb-3">            
                    <span class="input-group-text" id="email">Email</span>
                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email" id="email" disabled>
                
                    <div class="input-group-append">
                    <a type="button" class="btn btn-danger" href="{{ route('change-email') }}"  name="changeEmail">Change Email</a>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="currentPassword">Current</span>
                    <input type="password" name="currentPassword" class="form-control" placeholder="Password" >
                </div>
                @error('currentPassword')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="newPassword">New</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" >
                </div>
               
                <div class="input-group mb-3">
                    <span class="input-group-text" id="confirmPassword">Re-type New</span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password" >
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <button class="btn btn-secondary" type="submit">Reset Password</button>
            </form>
        </div>
        {{-- User Change Password --}}
        

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