@extends('partials.layout')



@section('content')
<div class="" style="margin-top: 25px;">

    <div class="jumbotron p-3 p-md-5 text-white rounded bg-secondary">
    
            <div class="container col-md-6 px-0">
            <h1 class="display-4">Title of a longer featured blog post</h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>

            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
            </div>

    </div>

    <div class="container">
        <h3 class="display-4">Latest Posts</h3>
        <hr>
    </div>
    

    <div class="container">
        <div class="card mb-3" style="max-width: 600px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="..." class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
    
    
@endsection