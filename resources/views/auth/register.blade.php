@extends('partials.authlayout')


@section('content')
  <div class="container">

  
      <form class="loginForm">

        <div class="row justify-content-center">
          <h2>Register</h2>
          
          <div class="col-md-6">
                <hr>
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form3Example1" class="form-control" />
                            <label class="form-label" for="form3Example1">First name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form3Example2" class="form-control" />
                            <label class="form-label" for="form3Example2">Middle name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form3Example2" class="form-control" />
                            <label class="form-label" for="form3Example2">Last name</label>
                        </div>
                    </div>
                </div>

            
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="date" id="form6Example1" class="form-control" />
                            <label class="form-label" for="form6Example1">Date of Birth</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form6Example2" class="form-control" />
                            <label class="form-label" for="form6Example2">Username</label>
                        </div>
                    </div>
                </div>

                
                <div class="form-outline mb-4">
                    <input type="email" id="form3Example3" class="form-control" />
                    <label class="form-label" for="form3Example3">Email address</label>
                </div>

      
                <div class="form-outline mb-4">
                    <input type="password" id="form3Example4" class="form-control" />
                    <label class="form-label" for="form3Example4">Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" id="form3Example4" class="form-control" />
                    <label class="form-label" for="form3Example4">Confirm Password</label>
                </div>

                <div class="form-outline mb-4">    
                    <input type="file" class="form-control" id="customFile" />
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
         
                <div class="text-center">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
          </div>
        </div> 
      </form>
  </div>
@endsection