@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">
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
                                
                                <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
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


            <div class="col-md-6">
                
                <h1 class="display-6">Followers - {{ $user->followers->count() }}</h1>
                
                <hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Date followed</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->followers as $follower)        
                                
                            <tr>
                                <td>
                                    <a href="/user/{{ $follower->id }}/profile" value="{{ $follower->id }}">
                                        {{ $follower->first_name . ' ' . $follower->last_name }}</a>
                                </td>
                                <td>
                                    {{ date("F j, Y", strtotime( $follower->created_at)) }}
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-danger btn-sm">Remove Follower</button>
                                </td> --}}
                            </tr>
                        
                        @empty
                            <div class="card-body">
                                <h1 class="display-6">You have no followers yet.</h1>

                            </div>
                        @endforelse            
                    </tbody>                       
                </table>            
                  
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