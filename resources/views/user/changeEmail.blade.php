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
     
            <h1 class="display-6 mt-5">Change Email</h1>
            <hr class="my-4">
            <p>Please enter your password and your new email address.</p>
            <p>Please make sure your new email account is active. We will send a verification link to your new email before you 
                can use your account.</p>

            <form method="POST" action="{{ route('reset-email') }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="email_verified" class="form-control" placeholder="Email" >

                <div class="input-group mb-3">            
                    <span class="input-group-text" id="email">Current</span>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="currentEmail" disabled >
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="currentPassword">Password</span>
                    <input type="password" name="current_password" class="form-control" placeholder="Password" >
                </div>
                @error('current_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="newEmail">New</span>
                    <input type="email" name="email" class="form-control" placeholder="Email" >
                </div>
               
                <div class="input-group mb-3">
                    <span class="input-group-text" id="confirmEmail">Re-type New</span>
                    <input type="email" name="email_confirmation" class="form-control" placeholder="Email" >
                </div>

                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <button class="btn btn-secondary" type="submit">Send Email Verification Link</button>
            </form>
        </div>
        {{-- User Change Password --}}
        

        {{-- Col --}}
        <div class="col-md">           
            <div class="container">
            <div class="row ">
                <div class="col">
                </div>
            </div>
            </div>          
        </div>
        {{-- Col --}}
    </div>
</div>
    
@endsection