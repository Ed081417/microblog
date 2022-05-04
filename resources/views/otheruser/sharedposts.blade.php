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

    {{-- Delete Shared Post Modal --}}
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
      {{-- Delete Shared Post Modal --}}

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
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Followers:<span class="badge bg-primary rounded-pill">{{  $user->followers->count() }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Following:<span class="badge bg-primary rounded-pill">{{  $user->followings->count() }}</span></li>
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-start">
                                Email:<span class="badge bg-primary rounded-pill">{{  $user->email }}</span></li> --}}
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
                    <h1 class="display-6">My Shared Posts</h1>
                @else
                    <h1 class="display-6">{{ $user->first_name }}'s Shared Posts</h1>
                @endif
                

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
                                <button type="button" value="{{$sharedpost->post->id }}" class="btn btn-danger float-end deleteBtn" >
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
                    <div class="container">
                        <h1 class="display-6">No Shared Post Yet.</h1>
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

            //Delete Shared Post
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