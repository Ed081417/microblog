@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                @include('partials.sidebar')
            </div>


            <div class="col-6">
                <h1 class="display-6">My Posts</h1>

                {{-- Shared Posts --}}
                @foreach ($posts as $post)
                    @foreach ($post->shares as $sharedpost)
                        @if ($sharedpost->user_id == Auth::user()->id)
                            <div class="card w-90">                
                                <div class="card-header imgHeader">
                                    <img src="{{asset('images/' . $sharedpost->user->image_path)}}" alt="..." class="rounded">
                                    <a href="/user/{{ $sharedpost->user->id }}/profile" value="{{ $sharedpost->user->id }}">
                                    {{ $sharedpost->user->first_name . ' ' . $sharedpost->user->last_name}}</a> 
                                    {{-- <span>You shared a post from <a href="/user/{{ $sharedpost->post->user->id }}/profile">
                                    {{ $sharedpost->post->user->first_name }} </a></span> --}}
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
                                    {{-- @if (!$post->likedBy(auth()->user()))
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
                                    @endif --}}

                                    <span style="float: right" class="text-muted">
                                    Shared on {{ date("F j, Y", strtotime( $sharedpost->created_at)) }} 
                                    </span>  
                
                                </div>
                            </div>
                        @endif
                    
                    @endforeach
                @endforeach
                {{-- Shared Posts --}}


                {{-- Users Posts --}}
                @foreach ($posts as $post)
                        
                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
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
                    
                @endforeach
                {{-- Users Posts --}}
            </div>

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