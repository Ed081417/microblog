@extends('partials.layout')



@section('content')
    
    <div class="container d-flex justify-content-center">
        <div class="card w-50 mb-5 ">
            <div class="card-header">
                <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                <a href="#">{{ $post->user->first_name . ' ' . $post->user->last_name}}</a>           
                
                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)

                    <a href="/post/{{ $post->id }}/edit" type="button"  value="{{ $post->id }}" class="btn btn-success float-end updateBtn" >
                    <i class="bi bi-pencil-square"></i></a>
                @endif    

            </div>
            
            <div class="card-body">
        
                    @if ($post->image_path=="")
                        <h3>{{ $post->title }}</h3>
                        <footer class="blockquote-footer"><span>Posted on 
                                {{ date("F j, Y", strtotime( $post->created_at)) }} </span></footer>
                        <div class="mb-3">
                            <p name="description" rows="5">{{ $post->description }}</p>
                        </div>
                    @else
                        <h3>{{ $post->title }}</h3>
                        
                        <div class="mb-3">
                            <p name="description" rows="5">{{ $post->description }}</p>
                            <span class="blockquote-footer">Posted on {{ date("F j, Y", strtotime( $post->created_at)) }} </span>
                        </div>

                        

                        <div class="mb-3">
                            <img src="{{asset('images/' . $post->image_path)}}" alt="..." class="img-fluid">               
                        </div>
                    @endif
                    
            </div>
            <div class="card-footer">    
                <span>8</span> <a href="#">Like</a> <span>|</span>
                <span>8</span> <a href="#">Comment</a> <span>|</span>
                <span>8</span> <a href="#">Share</a>

                @if ($post->created_at != $post->updated_at)
                    <small class="text-muted"><span style="float: right">Post updated on 
                        {{ date("F j, Y", strtotime( $post->updated_at)) }} </span></small>               
                @endif
            </div>
            
        </div>
    </div>
    
@endsection
