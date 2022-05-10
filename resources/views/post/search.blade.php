@extends('partials.layout')



@section('content')
    
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md">
            @include('partials.sidebar')
        </div>

        {{-- Search Result --}}

        <div class="col-md-6">

            {{-- Flash messages --}}
            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <div class="">
                <h1 class="display-6">Search result...</h1>

                {{-- @foreach ($results as $result)                 
                        <div class="card mb-3" style="max-width: 550px;">
                            <div class="row g-0" style="margin-top: 0;">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/' . $result->image_path) }}" class="img-thumbnail " >
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $result->first_name . ' ' . $result->last_name }}</h3>
                                        <p class="text-muted"> Date Joined: {{ date("F j, Y", strtotime( $result->created_at)) }}</p>
                                        <button class="btn btn-primary btn-sm">View Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                                        
                @endforeach --}}

                {{-- Users Posts --}}               
                @forelse ($posts as $post)
                    <div class="card w-90 mb-5">                
                        <div class="card-header imgHeader">
                        <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                        <a href="/user/{{ $post->user->id }}/profile" value="{{ $post->user->id }}">
                            {{ $post->user->first_name . ' ' . $post->user->last_name}}</a>                       
                        
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
                    <h1 class="mt-5">No result found.</h1>
                @endforelse

                {{ $posts->links() }}
            {{-- Users Posts --}}


            </div>
        </div>

        {{-- Search Result --}}
        

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