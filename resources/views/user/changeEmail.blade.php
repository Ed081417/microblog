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
     
            <h1 class="display-6">Change Email</h1>
            <hr class="my-4">
            <p>Please enter your new email.</p>

            <form method="" action="#">
                @csrf
                {{-- @method('PUT') --}}

                <div class="input-group mb-3">            
                    <span class="input-group-text" id="email">Current</span>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="currentEmail" disabled >
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="newEmail">New</span>
                    <input type="email" name="email" class="form-control" placeholder="Email" >
                </div>
               
                <div class="input-group mb-3">
                    <span class="input-group-text" id="confirmEmail">Re-type New</span>
                    <input type="email" name="email_confirmation" class="form-control" placeholder="Email" >
                </div>

                @error('email')
                    <p style="color: red">{{ $message }}</p>
                @enderror

                <button class="btn btn-secondary" type="submit">Reset Email</button>
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