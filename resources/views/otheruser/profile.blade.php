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

    <div class="row">
        <div class="col">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary" style="width: 280px;">
                <a href="#"> <img src="{{ asset('images/' . $user->image_path) }}" alt="..." class="img-thumbnail"> </a>
                <span class="fs-4" style="text-align: center;">{{ $user->first_name . ' ' .  $user->last_name}}</span>
                @if (Auth::user()->id != $user->id)
                    @if (!$user->followedBy(auth()->user()))
                        <form action="{{ route('follow', $user) }}" method="POST" class="d-flex justify-content-center">
                            @csrf

                            {{-- <input type="hidden" name="follow" value="{{ $user->id }}"> --}}
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    @else
                        {{-- <form action="{{ route('unfollow') }}" method="POST" class="d-flex justify-content-center">
                            @csrf --}}

                            {{-- <input type="hidden" name="unfollow_user_id" value="{{ $user->id }}"> --}}
                            <div class="container d-flex justify-content-center">
                                <button type="submit" value="{{ $user->id }}" class="btn btn-dark unfollowBtn">Unfollow</button>
                            </div>
                            
                        {{-- </form> --}}
                    @endif
                @endif

                {{-- @if (!$user->followedBy(auth()->user()))
                    <form action="{{ route('like-post', $user) }}" method="POST" style ="display:inline-block;">
                        @csrf
                        <span class="badge bg-secondary">{{ $user->likes->count() }}</span>
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
                @endif --}}
            
            </div>
        </div>

        {{-- User Profile --}}

        <div class="col-6">
           
            
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


                <h3>{{ $user->first_name }} {{ $user->last_name }} Posts</h3>
         

       

            </div>
            

             {{-- Flash messages --}}
            {{-- <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <div class="card">
                <h5 class="card-header">My Profile</h5>
                <div class="card-body">
                    <h5>First Name: {{ Auth::user()->first_name }}</h5>
                    <hr>
                    <h5>Middle Name: {{ Auth::user()->middle_name }}</h5>
                    <hr>
                    <h5>Last Name: {{ Auth::user()->last_name }}</h5>
                    <hr>
                    <h5>Date of Birth: {{ date("F j, Y", strtotime( Auth::user()->date_of_birth)) }} </h5>
                    <hr>
                    <h5>Username: {{ Auth::user()->username }}</h5>
                    <hr>
                    <h5>Email: {{ Auth::user()->email }}</h5>
                    <hr>
                    <h5>Account Created: {{ date("F j, Y", strtotime( Auth::user()->created_at)) }} </h5>
                    <hr>
                    <h5 for="description" c>Profile Image :</h5>
                    <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="img-fluid"> 
                    <hr>              
            
                </div>
            </div> --}}
        </div>
        {{-- User Profile --}}
        

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

            //Unfollow
            $('.unfollowBtn').click(function (e) {
            e.preventDefault();

            var unfollow_user_id = $(this).val();
            // console.log(delete_post_id);
            $("#unfollow_user_id").val(unfollow_user_id);
            $('#unfollowModal').modal('show');
            
            });

        });

    </script>
    
@endsection