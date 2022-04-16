@extends('partials.authlayout')


@section('content')
  <div class="container">

  
      <form class="loginForm">
        <!-- Email input -->
        <div class="row justify-content-center">
          <h2>Login</h2>
          <div class="col-md-4">

          
              <div class="form-outline mb-4 ">
                <input type="email" id="form2Example1" class="form-control" />
                <label class="form-label" for="form2Example1">Email address</label>
              </div>
            

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form2Example2" class="form-control" />
              <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example34"  />
                  <label class="form-check-label" for="form2Example34"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
      
            <!-- Register buttons -->
            <div class="text-center">
              <p>Need an Account? <a href="{{ route('register') }}">Register</a></p>
          
            </div>
          </div>
        </div> 
      </form>
  </div>
@endsection