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

              <div class="row ">
                <div class="col">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#postModal">
                    <i class="bi bi-pencil-square"></i> Make a Post
                  </button>

                  <!-- Create Post Modal -->
                  <form action="{{ route('posts') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="postModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="postModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">Write Something</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                          </div>

                          
                            <div class="modal-body"> 
                                    {{-- <div class="alert alert-danger" style="display:none"></div>       --}}

                                    <div class="mb-3">
                                      <input type="text" class="form-control" name="title" placeholder="Title" required>
                                      {{-- @error('title')
                                          <span style="color: red;">*Title is required!</span>
                                      @enderror --}}
                                    </div>
                                    
                                    <div class="mb-3">
                                      <textarea class="form-control" name="description" placeholder="Description" rows="6" required></textarea>
                                      {{-- @error('description')
                                          <span style="color: red;">*Description is required!</span>
                                      @enderror --}}
                                    </div>
                                    
                                    <div class="mb-3">
                                      <input type="file" class="form-control" name="image" id="image" >
                                      <img id="uploadedImg" class="img-fluid">
                                    </div>                            
                            </div>

                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary" id="formSubmit">Post</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          

                        </div>
                      </div>
                    </div>

                    
                  </form>
                  
                  {{-- Create Post Modal --}}


                  <!-- Delete Post Modal -->
                  <form action=" {{ route('delete-post') }} " method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                          </div>

                            <input type="hidden" name="delete_post_id" id="delete_post_id">
                            
                            <div class="modal-body"> 
                                    <p>Do you want to delete this post?</p>                         
                            </div>

                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Delete</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                          
                        </div>
                      </div>
                    </div>
                  </form>           
                  {{-- Delete Post Modal --}}

                  

                  {{-- Users Posts --}}
                  @foreach ($posts as $post)
                    
                    <div class="card w-90">                
                      <div class="card-header imgHeader">
                        <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                        <a href="#">{{ $post->user->first_name . ' ' . $post->user->last_name}}</a>
                    
                        
                       
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                          <button type="button" value="{{ $post->id }}" class="btn btn-danger float-end deleteBtn" >
                            <i class="bi bi-trash"></i></button>

                          <a href="/post/{{ $post->id }}/edit" type="button"  value="{{ $post->id }}" class="btn btn-success float-end updateBtn" >
                            <i class="bi bi-pencil-square"></i></a>
                        @endif                     
                        
                      </div>

                      <div class="card-body">

                          @if ($post->image_path=="")
                            <a href="#"> <h5>{{ $post->title }}</h5> </a>
                            <p class="card-text">{{ $post->description }}</p>
                          @else
                            <a href="#"> <h5>{{ $post->title }}</h5> </a>
                            <p class="card-text">{{ $post->description }}</p>
                            <img src="{{asset('images/' . $post->image_path)}}" alt="..." class="img-fluid">
                          @endif

                      </div>

                      <div class="card-footer">
                        <span>8</span> <a href="#">Like</a> <span>|</span>
                        <span>8</span> <a href="#">Comment</a> <span>|</span>
                        <span>8</span> <a href="#">Share</a> 

                        <span style="float: right">
                          Posted on {{ date("F j, Y", strtotime( $post->created_at)) }} 
                        </span>
                        {{-- <span style="float: right">
                          Post updated on {{ date("F j, Y", strtotime( $post->updated_at)) }} 
                        </span> --}}

                      </div>
                    </div>
                  @endforeach
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

@section('scripts')
    <script>
      $(document).ready(function(){

          //Image upload preview
          image.onchange = evt => {
              const [file] = image.files
              if (file) {
                uploadedImg.src = URL.createObjectURL(file)
              }
          }

          //Delete Post
          $('.deleteBtn').click(function (e) {
            e.preventDefault();

            var delete_post_id = $(this).val();
            // console.log(delete_post_id);
            $("#delete_post_id").val(delete_post_id);
            $('#deleteModal').modal('show');
           
          });
      });

    </script>
    
@endsection



