@extends('partials.layout')

@section('content')

    <div class="container" style="margin-top: 20px;">

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

                {{-- Shared Posts --}}
                <h1 class="display-6">My Shared Posts</h1>          
                @forelse ($sharedPosts as $sharedpost)

                    {{-- Delete Shared Post Modal --}}
                    <form action=" {{ route('delete-shared', $sharedpost) }} " method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                            </div>

                                {{-- <input type="hidden" name="delete_shared_id" id="delete_shared_id"> --}}
                                
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

                        <div class="card w-90 mb-5">                
                            <div class="card-header imgHeader">

                                @if (is_null( Auth::user()->image_path))
                                    <img src="{{asset('images/default.png')}}" alt="..." class="rounded">
                                    <a href="#">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name}}</a>  
                                @else
                                    <img src="{{asset('images/' . Auth::user()->image_path)}}" alt="..." class="rounded">
                                    <a href="/user/{{ Auth::user()->id }}/profile" value="{{ Auth::user()->id }}">
                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name}}</a>    
                                @endif  
                                    
                                @if ($trashedPosts->contains('id', $sharedpost->post_id))
                                    <span>Shared post deleted</span>

                                @else
                                    <span>You shared a post from <a href="/user/{{ $sharedpost->post->user_id }}/profile">
                                        {{ $sharedpost->post->user->first_name }} </a></span>

                                @endif
            
                                @if (isset(Auth::user()->id) && Auth::user()->id == $sharedpost->user_id)
                                    <button type="button" value="{{ $sharedpost->id }}" class="btn btn-danger btn-sm float-end deleteBtn" >
                                        <i class="bi bi-trash"></i></button>
                                @endif         
                            
                            </div>

                            <div class="card-body">
                                @if ($trashedPosts->contains('id', $sharedpost->post_id))
                                    <h3>Content is not available</h3>
                                
                                @else    
                                    @if (!empty($sharedpost->post->image_path))
                                        <a href="/post/{{ $sharedpost->post_id }}/view" type="button" > 
                                        <h5>{{ $sharedpost->post->title }}</h5> </a> <p class="card-text">{{ $sharedpost->post->description }}</p>
                                        <img src="{{asset('images/' . $sharedpost->post->image_path)}}" alt="..." class="img-fluid"> 
                                    @else
                                        <a href="/post/{{ $sharedpost->post_id }}/view" type="button"  > 
                                        <h5>{{ $sharedpost->post->title }}</h5> </a> <p class="card-text">{{ $sharedpost->post->description }}</p>
                                    @endif
                                    
                                @endif

                            </div>

                            <div class="card-footer" style="display: inline;">
                                @if ($trashedPosts->contains('id', $sharedpost->post_id))
                                    <span style="float: right" class="text-muted"></span>
                                @else
                                    <span class="badge bg-primary">
                                        {{ $sharedpost->post->likes->count() }} {{ Str::plural('Like', $sharedpost->post->likes->count()) }}
                                    </span>
            
                                    <span class="badge bg-primary">
                                        {{ $sharedpost->post->comments->count() }} {{ Str::plural('Comment', $sharedpost->post->comments->count()) }}
                                    </span>                       
                                    
                                    <span class="badge bg-primary">
                                        {{ $sharedpost->post->shares->count($sharedpost->id) }} {{ Str::plural('Share', $sharedpost->post->shares->count($sharedpost->id)) }}
                                    </span>
            
                                    <span style="float: right" class="text-muted">
                                        Shared on {{ date("F j, Y", strtotime( $sharedpost->created_at)) }} 
                                    </span>  
                                @endif
                            </div>

                        </div>                

                @empty
                  
                    <h1 class="display-6 mt-5">You have no shared Post Yet.</h1>
                    
                @endforelse
                {{-- Shared Posts --}}

                {{$sharedPosts->links()}}
            </div>

            {{-- Col --}}
            <div class="col-md">           
                <div class="container">
                <div class="row ">
                    <div class="col">

                    </div>
                </div>
                </div>          
            </div>
            {{-- Col --}}
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