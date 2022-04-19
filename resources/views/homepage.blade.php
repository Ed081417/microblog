@extends('partials.layout')



@section('content')


    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark"> 
    
            <div class="container col-md-6 px-0 headerjumbotron" >
              <h1 class="display-4">Start Your Blogging Career Here!</h1>
              <hr>
            </div>

    </div>
    

    <div class="container">
      <div class="row" style="text-align: center;">
        <div class="col-lg-4 ">
          <img class="rounded-circle" src="{{asset('assets/img/w1.png')}}" alt="Generic placeholder image" width="140" height="140">
          <h2>Post</h2>
      
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="{{asset('assets/img/follow.png')}}" alt="Generic placeholder image" width="140" height="140">
          <h2>Follow</h2>
       
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="{{asset('assets/img/l2.png')}}" alt="Generic placeholder image" width="140" height="140">
          <h2>Interact</h2>
       
        </div><!-- /.col-lg-4 -->
      </div>
    </div>

  

    
    
@endsection