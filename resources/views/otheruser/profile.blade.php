@extends('partials.layout')



@section('content')
    
<div class="container" style="margin-top: 20px;">

    {{-- Unfollow Modal --}}
    <form action=" {{ route('unfollow') }} " method="POST">
        @csrf
        
        <div class="modal fade" id="unfollowModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="unfollowLabel"
             aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="unfollowLabel">Unfollow</h5>
              </div>

                <input type="hidden" name="unfollow_user_id" id="unfollow_user_id">
                
                <div class="modal-body"> 
                        <p>Are you sure you want to unfollow this person?</p>                         
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Unfollow</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              
            </div>
          </div>
        </div>
    </form>           
    {{-- Unfollow Modal --}}

    {{-- Share Post Modal --}}
    <form action="{{ route('share-post') }}" method="post" >
        @csrf
      
        <div class="modal fade" id="shareModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="shareModalLabel" 
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share Post</h5>
              </div>

                <input type="hidden" name="share_post_id" id="share_post_id">
                        
                <div class="modal-body"> 
                        <p>Do you want to share this post?</p>                         
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Share</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              
            </div>
          </div>
        </div>
      </form>           
      {{-- Share Post Modal --}} 

    <div class="row">
        <div class="col-md">
            <div class="card " style="max-width: 18rem;" >
                @if (is_null($user->image_path))
                    <a href="{{ route('user-posts') }}">
                        <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="...">
                    </a>
                @else
                    <a href="{{ route('user-posts') }}">
                        <img src="{{ asset('images/' . $user->image_path) }}" class="card-img-top" alt="...">
                    </a>
                @endif
                
                @if ($user->middle_name=="")
                    <h4 class="fs-4" style="text-align: center;">{{ $user->first_name . ' ' .  $user->last_name}}</h4>
                @else
                  <div class="card-header">
                    <h4 class="fs-4" style="text-align: center;">
                        {{ $user->first_name . ' ' . $user->middle_name . ' ' .  $user->last_name}}</h4>
                  </div>
                @endif
                
                <div class="card-body">
                    @if (Auth::user()->id != $user->id)
                        @if (!$user->followedBy(auth()->user()))
                            <form action="{{ route('follow', $user) }}" method="POST" class="d-flex justify-content-center">
                                @csrf

                                {{-- <input type="hidden" name="follow" value="{{ $user->id }}"> --}}
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>

                        @else
                            <div class="container d-flex justify-content-center">
                                <button type="submit" value="{{ $user->id }}" class="btn btn-secondary unfollowBtn">Unfollow</button>
                            </div>
                                
                        @endif

                        <ul class="list-group mt-2">
                            <li class="list-group-item active" aria-current="true">PROFILE</li>

                            <a href="/user/{{ $user->id }}/shared" class="list-group-item list-group-item-action">Shared Posts</a>

                            <a href="/profile/{{ $user->id }}/followers" class="list-group-item d-flex justify-content-between align-items-start">
                                Followers:<span class="badge bg-primary rounded-pill">{{  $user->followers->count() }}</span></a>
                            
                            <a href="/profile/{{ $user->id }}/followings" class="list-group-item d-flex justify-content-between align-items-start">
                                Following:<span class="badge bg-primary rounded-pill">{{  $user->followings->count() }}</span></a>
                    
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Birthdate:<span class="badge bg-primary rounded-pill">
                                    {{ date("F j, Y", strtotime( $user->date_of_birth)) }}</span></li>

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Date Joined:<span class="badge bg-primary rounded-pill">
                                    {{ date("F j, Y", strtotime( $user->created_at)) }}</span></li>

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <span class="badge bg-primary rounded-pill">{{  $user->email }}</span></li>
                        </ul>
                    

                    @else    
                        <div class="list-group">
                            <a href="{{ route('user-posts') }}" class="list-group-item list-group-item-action ">Posts</a>
                            <a href="/user/{{ $user->id }}/shared" class="list-group-item list-group-item-action">Shared Posts</a>
                            <a href="{{ route('followers') }}" 
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                Followers<span class="badge bg-primary rounded-pill">{{ Auth::user()->followers->count() }}</span></a>
                
                            <a href="{{ route('followings') }}" 
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                Following<span class="badge bg-primary rounded-pill">{{ Auth::user()->followings->count() }}</span></a>
                
                            <a href="{{ route('find-people') }}" class="list-group-item list-group-item-action">Find People</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- User Profile --}}

        <div class="col-md-6">
           
            
            <div class="container">
                {{-- Flash messages --}}
                @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                </div>
                @elseif (session()->has('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('status') }}
                </div>
                @endif

                @if (Auth::user()->id == $user->id)
                    <h1 class="display-6">My Posts</h1>
                @else
                    <h1 class="display-6">{{ $user->first_name }} {{ $user->last_name }}'s Posts</h1>
                @endif
                

                @forelse ($user->user->sortByDesc('updated_at') as $post)
                    <div class="card w-90">                
                        <div class="card-header imgHeader">

                        @if (is_null($post->user->image_path))
                            <img src="{{asset('images/default.png')}}" alt="..." class="rounded">
                            <a href="/user/{{ $post->user->id }}/profile" value="{{ $post->user->id }}">
                                {{ $post->user->first_name . ' ' . $post->user->last_name}}</a> 
                        @else
                            <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                            <a href="/user/{{ $post->user->id }}/profile" value="{{ $post->user->id }}">
                                {{ $post->user->first_name . ' ' . $post->user->last_name}}</a>   
                        @endif                      
                        
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
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

                        {{-- <span>{{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}</span> --}}

                        <div class="card-footer" style="display: inline;">
                            @if (!$post->likedBy(auth()->user()))
                            <form action="{{ route('like-post', $post) }}" method="POST" style ="display:inline-block;">
                                @csrf
                                <span class="badge bg-secondary">{{ $post->likes->count() }}</span>
                                <button type="submit" class="btn btn-primary btn-sm"> Like </button> 
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

                @empty
                    <div class="container">
                        <h1 class="display-6">No Post Yet.</h1>
                    </div>
                @endforelse
         

       

            </div>
            
        </div>
        {{-- User Profile --}}
        

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

            //Unfollow
            $('.unfollowBtn').click(function (e) {
            e.preventDefault();

            var unfollow_user_id = $(this).val();
            // console.log(delete_post_id);
            $("#unfollow_user_id").val(unfollow_user_id);
            $('#unfollowModal').modal('show');
            
            });

            //Share Post
            $('.sharedBtn').click(function (e) {
                e.preventDefault();

                var share_post_id = $(this).val();
                $("#share_post_id").val(share_post_id);
                $('#shareModal').modal('show');
            
            });

        });

    </script>
    
@endsection