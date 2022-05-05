@extends('partials.layout')

@section('content')

    <div class="container" style="margin-top: 20px;">

    {{-- Delete Shared Post Modal --}}
    <form action=" {{ route('delete-shared') }} " method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>

                <input type="hidden" name="delete_shared_id" id="delete_shared_id">
                
                <div class="modal-body"> 
                        <p>Do you want to delete this shared post?</p>                         
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            
            </div>
        </div>
        </div>
    </form>           
    {{-- Delete Shared Post Modal --}}

        <div class="row">
            <div class="col-md">
                @include('partials.sidebar')
            </div>


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

                <h1 class="display-6">My Shared Posts</h1>

                {{-- Shared Posts --}}
                {{-- @foreach ($posts as $post)                
                        @foreach ($post->shares as $sharedpost)

                                @if ($sharedpost->user_id == Auth::user()->id)
                                    <div class="card w-90">                
                                        <div class="card-header imgHeader">

                                            @if (is_null( $sharedpost->user->image_path))
                                                <img src="{{asset('images/default.png')}}" alt="..." class="rounded">
                                                <a href="#">{{ $sharedpost->user->first_name . ' ' . $sharedpost->user->last_name}}</a>  
                                            @else
                                                <img src="{{asset('images/' . $sharedpost->user->image_path)}}" alt="..." class="rounded">
                                                <a href="/user/{{ $sharedpost->user->id }}/profile" value="{{ $sharedpost->user->id }}">
                                                    {{ $sharedpost->user->first_name . ' ' . $sharedpost->user->last_name}}</a>    
                                            @endif  

                                            @if ($sharedpost->user_id == Auth::user()->id)
                                                <span>You shared a post from <a href="/user/{{ $sharedpost->post->user->id }}/profile">
                                                    {{ $sharedpost->post->user->first_name }} </a></span>
                                            
                                            @elseif($sharedpost->post->user_id == Auth::user()->id)
                                                <span>Shared a post from you.</span>
                                            
                                            @else
                                                <span>Shared a post from <a href="/user/{{ $sharedpost->post->user->id }}/profile">
                                                    {{ $sharedpost->post->user->first_name }} </a></span>
                                            @endif
                                            
                                        
                                            @if (isset(Auth::user()->id) && Auth::user()->id == $sharedpost->user_id)
                                                <button type="button" value="{{ $sharedpost->id }}" class="btn btn-danger float-end deleteBtn" >
                                                    <i class="bi bi-trash"></i></button>

                                            @endif                     
                                            
                                        </div>

                                        <div class="card-body">

                                            @if ($sharedpost->post->image_path=="")
                                                <a href="/post/{{ $sharedpost->post->id }}/view" type="button"  value="{{ $sharedpost->post->id }}"> 
                                                <h5>{{ $sharedpost->post->title }}</h5> </a> <p class="card-text">{{ $sharedpost->post->description }}</p>
                                            @else
                                                <a href="/post/{{ $sharedpost->post->id }}/view" type="button"  value="{{ $sharedpost->post->id }}"> 
                                                <h5>{{ $post->title }}</h5> </a> <p class="card-text">{{ $post->description }}</p>
                                                <img src="{{asset('images/' . $sharedpost->post->image_path)}}" alt="..." class="img-fluid">
                                            @endif

                                        </div>

                                        <div class="card-footer" style="display: inline;">

                                            <span style="float: right" class="text-muted">
                                                Shared on {{ date("F j, Y", strtotime( $sharedpost->created_at)) }} 
                                            </span>  
                        
                                        </div>
                                    </div>  
              
                                @endif
                                                
                        @endforeach                        
                @endforeach --}}


                @forelse ($user->shares->sortByDesc('updated_at') as $sharedpost)
                    <div class="card w-90">                
                        <div class="card-header imgHeader">

                            @if (is_null( $sharedpost->user->image_path))
                                <img src="{{asset('images/default.png')}}" alt="..." class="rounded">
                                <a href="#">{{ $sharedpost->user->first_name . ' ' . $sharedpost->user->last_name}}</a>  
                            @else
                                <img src="{{asset('images/' . $sharedpost->user->image_path)}}" alt="..." class="rounded">
                                <a href="/user/{{ $sharedpost->user->id }}/profile" value="{{ $sharedpost->user->id }}">
                                    {{ $sharedpost->user->first_name . ' ' . $sharedpost->user->last_name}}</a>    
                            @endif  

                            @if ($sharedpost->user_id == Auth::user()->id)
                                <span>You shared a post from <a href="/user/{{ $sharedpost->post->user->id }}/profile">
                                    {{ $sharedpost->post->user->first_name }} </a></span>
                            
                            @elseif($sharedpost->post->user_id == Auth::user()->id)
                                <span>Shared a post from you.</span>
                            
                            @else
                                <span>Shared a post from <a href="/user/{{ $sharedpost->post->user->id }}/profile">
                                    {{ $sharedpost->post->user->first_name }} </a></span>
                            @endif
                            
                        
                            @if (isset(Auth::user()->id) && Auth::user()->id == $sharedpost->user_id)
                                <button type="button" value="{{ $sharedpost->id }}" class="btn btn-danger float-end deleteBtn" >
                                    <i class="bi bi-trash"></i></button>

                            @endif         
                        
                        </div>

                        <div class="card-body">

                            @if ($sharedpost->post->image_path=="")
                                <a href="/post/{{ $sharedpost->post->id }}/view" type="button"  value="{{ $sharedpost->post->id }}"> 
                                <h5>{{ $sharedpost->post->title }}</h5> </a> <p class="card-text">{{ $sharedpost->post->description }}</p>
                            @else
                                <a href="/post/{{ $sharedpost->post->id }}/view" type="button"  value="{{ $sharedpost->post->id }}"> 
                                <h5>{{ $sharedpost->post->title }}</h5> </a> <p class="card-text">{{ $sharedpost->post->description }}</p>
                                <img src="{{asset('images/' . $sharedpost->post->image_path)}}" alt="..." class="img-fluid">
                            @endif

                        </div>

                        <div class="card-footer" style="display: inline;">

                            <span style="float: right" class="text-muted">
                                Shared on {{ date("F j, Y", strtotime( $sharedpost->created_at)) }} 
                            </span>  
        
                        </div>

                    </div>

                @empty
                  
                    <h1 class="display-6 mt-5">You have no shared Post Yet.</h1>
                    
                @endforelse
                {{-- Shared Posts --}}


            </div>

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

@section('scripts')
    <script>
      $(document).ready(function(){

          //Delete Shared Post
          $('.deleteBtn').click(function (e) {
            e.preventDefault();

            var delete_shared_id = $(this).val();
            //console.log(delete_shared_id);
            $("#delete_shared_id").val(delete_shared_id);
            $('#deleteModal').modal('show');
           
          });

      });

    </script>
    
@endsection