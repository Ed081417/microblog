@extends('partials.authlayout')


@section('content')
  <div class="container">

  
      <form class="loginForm">

        <div class="row justify-content-center">
          <h2>Forgot Password</h2>
          <div class="col-md-4">

            <hr>
              <div class="form-outline mb-4 ">
                <input type="email" name="uemail" id="uemail" class="form-control" />
                <label class="form-label" for="uemail">Enter email address</label>
              </div>
            

            <button type="submit" class="btn btn-primary btn-block mb-4">Send</button>

            <a type="button" class="btn btn-danger btn-block mb-4" href="{{ route('login') }}">Back to Login</a>

          </div>    
            
        </div> 
      </form>
  </div>
@endsection