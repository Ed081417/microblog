@extends('partials.layout')



@section('content')

    
    <div class="container sidebar" style="margin-top: 20px;">
      <div class="row ">
        {{-- Sidebar --}}
        <div class="col">
          <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary" style="width: 280px;">
            <a href="#"> <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="img-thumbnail"> </a>
            {{-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> --}}
            <span class="fs-4" style="text-align: center;">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}</span>
            {{-- </a> --}}
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link text-white" aria-current="home">
                  Home
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  Posts
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">  
                  Followers
                </a>
              </li>
            </ul>
            <hr>

          </div>
        </div>
        {{-- Sidebar --}}


        {{-- Posts --}}
        <div class="col-6 ">           
            <div class="container">
              <div class="row ">
                <div class="col">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#postModal">
                    <i class="bi bi-pencil-square"></i> Make a Post
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="postModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="postModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="postModalLabel">Write Something</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">                       
                            <div class="mb-3">
                              <input type="text" class="form-control" id="postTitle" placeholder="Title">
                            </div>
                            
                            <div class="mb-3">
                              <textarea class="form-control" id="postDescription" placeholder="Description"></textarea>
                            </div>
                            
                            <div class="mb-3">
                              <input type="file" class="form-control" id="postTitle" >
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Post</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- Modal --}}


                  {{-- Users Posts --}}
                  <div class="card w-90">                   
                    <div class="card-header imgHeader">
                      <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="rounded">
                      {{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">One Piece Red</h5>
                      <p class="card-text">One piece new Movie One Piece Red.</p>
                      <img src="{{asset('assets/img/opred.png')}}" alt="..." class="img-fluid">
                    </div>
                    <div class="card-footer">
                      <span>8</span> <a href="#">Like</a> <span>|</span>
                      <span>8</span> <a href="#">Comment</a> <span>|</span>
                      <span>8</span> <a href="#">Share</a> 
                    </div>
                  </div>

                  <div class="card w-90">                   
                    <div class="card-header imgHeader">
                      <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="rounded">
                      {{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">One Piece Red</h5>
                      <p class="card-text">One piece new Movie One Piece Red.</p>
                      <img src="{{asset('assets/img/opred.png')}}" alt="..." class="img-fluid">
                    </div>
                    <div class="card-footer">
                      <span>8</span> <a href="#">Like</a> <span>|</span>
                      <span>8</span> <a href="#">Comment</a> <span>|</span>
                      <span>8</span> <a href="#">Share</a> 
                    </div>
                  </div>
                  {{-- Users Posts --}}

                </div>
              </div>
            </div>          
        </div>
        {{-- Posts --}}


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