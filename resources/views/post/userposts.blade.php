@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">

        {{-- Delete Post Modal --}}
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

                <h1 class="display-6">My Posts</h1>


                {{-- Users Posts --}}
                @forelse ($users as $post)
                        
                    @if (Auth::user()->id == $post->user_id)
                        <div class="card w-90 mb-5">                
                            <div class="card-header imgHeader">
                                @if (is_null($post->user->image_path))
                                    <img src="{{asset('images/default.png')}}" alt="..." class="rounded">
                                    <a href="#">{{ $post->user->first_name . ' ' . $post->user->last_name}}</a> 
                                @else
                                    <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                                    <a href="/user/{{ $post->user->id }}/profile" value="{{ $post->user->id }}">
                                        {{ $post->user->first_name . ' ' . $post->user->last_name}}</a>   
                                @endif  
                            
                                @if (Auth::user()->id == $post->user_id)
                                <button type="button" value="{{ $post->id }}" class="btn btn-danger float-end deleteBtn" >
                                    <i class="bi bi-trash"></i></button>

                                <a href="/post/{{ $post->id }}/edit" type="button"  value="{{ $post->id }}" class="btn btn-success float-end updateBtn" >
                                    <i class="bi bi-pencil-square"></i></a>
                                @endif                     
                                
                            </div>

                            <div class="card-body">

                                @if ($post->image_path=="")
                                    <a href="/post/{{ $post->id }}/view" type="button"  value="{{ $post->id }}"> <h5>{{ $post->title }}</h5> </a>
                                    <p class="card-text">{{ $post->description }}</p>
                                @else
                                    <a href="/post/{{ $post->id }}/view" type="button"  value="{{ $post->id }}"> <h5>{{ $post->title }}</h5> </a>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <img src="{{asset('images/' . $post->image_path)}}" alt="..." class="img-fluid">
                                @endif

                            </div>

                            <div class="card-footer" style="display: inline;">
                                @if (!$post->likedBy(auth()->user()))
                                <form action="{{ route('like-post', $post) }}" method="POST" style ="display:inline-block;">
                                      @csrf
                                      <span class="badge bg-secondary">{{ $post->likes->count() }}</span>
                                      <button type="submit" class="btn btn-primary btn-sm">
                                        {{ Str::plural('Like', $post->likes->count()) }} </button> 
                                </form>
                                @else
                                  <form action="{{ route('unlike-post', $post) }}" method="POST" style ="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                
                                        <span class="badge bg-secondary">{{ $post->likes->count() }}</span>
                                        <button type="submit" class="btn btn-primary btn-sm">Unlike</button> 
                                  </form>
                                @endif
      
                                
                                <span class="badge bg-secondary">{{ $post->comments->count() }}</span>
                                <a href="/post/{{ $post->id }}/view" type="button"  value="{{ $post->id }}" type="button" 
                                  class="btn btn-primary btn-sm"> Comment </a> 
                              
                                  
                                <span class="badge bg-secondary">{{ $post->shares->count($post->id) }}</span>
                                @if (!$post->sharedBy(auth()->user()) && $post->user_id != Auth::user()->id)
                                    <button type="button" value="{{ $post->id }}" class="btn btn-primary btn-sm sharedBtn" >
                                        Share</button>

                                @elseif($post->sharedBy(auth()->user()))
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#shareModal" disabled> Shared </button> 

                                @else
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#shareModal" disabled> Share </button>
                                @endif
      
                                @if ($post->created_at == $post->updated_at)
                                  <span style="float: right" class="text-muted">
                                    Posted on {{ date("F j, Y", strtotime( $post->created_at)) }} 
                                  </span>              
                                @else
                                  <span style="float: right" class="text-muted">
                                    Post Updated on {{ date("F j, Y", strtotime( $post->updated_at)) }} 
                                  </span>
                                @endif
          
                            </div>
                        </div>
                    @endif

                @empty
                              
                    <h1 class="display-6 mt-5">You have no post yet.</h1>
                     
                @endforelse

                {{ $users->links() }}
                {{-- Users Posts --}}
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