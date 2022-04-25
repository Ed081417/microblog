@extends('partials.layout')



@section('content')
    
    <div class="container d-flex justify-content-center">

        {{-- Delete Post Modal --}}
        <form action="  {{ route('delete-comment') }} " method="POST">
            @csrf
            
            <div class="modal fade" id="deleteCommentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteCommentLabel"
                 aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteCommentLabel">Delete Post</h5>
                  </div>

                    <input type="hidden" name="delete_comment_id" id="delete_comment_id">
                    
                    <div class="modal-body"> 
                            <p>Do you want to delete this comment?</p>                         
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

        {{-- Update Post Modal --}}
        <form action="{{ route('update-comment') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="modal fade" id="updateCommentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="updateCommentLabel"
               aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="updateCommentLabel">Update Comment</h5>
                </div>

                  <input type="hidden" name="update_comment_id" id="update_comment_id">
                  
                  <div class="modal-body"> 
                    
                    <div class="mb-3">
                      <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                
              </div>
            </div>
          </div>
        </form>           
        {{-- Update Post Modal --}}



        <div class="card w-50 mb-5 ">
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

            <div class="card-header">
                <img src="{{asset('images/' . $post->user->image_path)}}" alt="..." class="rounded">
                <a href="#">{{ $post->user->first_name . ' ' . $post->user->last_name}}</a>           
                
                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)

                    <a href="/post/{{ $post->id }}/edit" type="button"  value="{{ $post->id }}" class="btn btn-success 
                        float-end updateBtn" ><i class="bi bi-pencil-square"></i></a>
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

            {{-- <span>{{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}</span> --}}
        
            <div class="card-footer" style="display: inline;">
                @if (!$post->likedBy(auth()->user()))
                  <form action="{{ route('like-post', $post) }}" method="POST" style ="display:inline-block;">
                        @csrf
                        <span class="badge bg-secondary">{{ $post->likes->count() }}</span>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Like </button> 
                  </form>
                @else
                  <form action="{{ route('unlike-post', $post) }}" method="POST" style ="display:inline-block;">
                        @csrf
                        @method('DELETE')

                        <span class="badge bg-secondary">{{ $post->likes->count() }}</span>
                        <button type="submit" class="btn btn-primary btn-sm">Unlike</button> 
                  </form>
                @endif

                  <form action="#" style ="display:inline-block;">
                        @csrf
                        <span class="badge bg-secondary">{{ $post->comments->count() }}</span>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Comments </button> 
                  </form>
                  <form action="#" style ="display:inline-block;">
                        @csrf
                        <span class="badge bg-secondary">{{ $post->comments->count() }}</span>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Share </button> 
                  </form>

                  @if ($post->created_at == $post->updated_at)
                    <span style="float: right">
                      Posted on {{ date("F j, Y", strtotime( $post->created_at)) }} 
                    </span>              
                  @else
                    <span style="float: right">
                      Post Updated on {{ date("F j, Y", strtotime( $post->updated_at)) }} 
                    </span>
                  @endif

            </div>
           
            <div class="card-header">Comments </div>

                <form action="{{ route('comment-post', $post) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Enter Comment..."></textarea>
                            
                        </div>
                        <button type="submit" class="btn btn-secondary ">Submit</button>
                    </div>    

                </form>
                
                
                @forelse ($post->comments as $comment)
                             
                    <div class="card-body">

                        <h5><a href="/user/{{ $post->user->id }}/profile" value="{{ $post->user->id }}">
                                {{ $comment->user->first_name . ' ' . $comment->user->last_name}}</a></h5>

                        

                        @if (isset(Auth::user()->id) && Auth::user()->id == $comment->user_id)
                            <button type="button" value="{{ $comment->id }}" class="btn btn-danger btn-sm float-end deleteBtn" >
                              <i class="bi bi-trash"></i></button>

                            <button type="button"  value="{{ $comment->id }}" class="btn btn-success btn-sm float-end updateBtn" > 
                              <i class="bi bi-pencil-square"></i></button>
                        @endif   

                        <p>{{ $comment->comment }}</p>

                        <footer class="blockquote-footer">commented on {{ date("F j, Y", strtotime( $comment->created_at)) }}</footer>
                        <hr>

                    </div>

                @empty
                    <div class="card-body">
                        <h5>No Comments Yet.</h5>
                    </div>
                    
                @endforelse
        
        </div>

       
    </div>
    
@endsection


@section('scripts')
    <script>
      $(document).ready(function(){

          //Delete Post
          $('.deleteBtn').click(function (e) {
            e.preventDefault();

            var delete_comment_id = $(this).val();
            // console.log(delete_post_id);
            $("#delete_comment_id").val(delete_comment_id);
            $('#deleteCommentModal').modal('show');
           
          });

          //Update Post
          $(document).on('click', '.updateBtn', function() {

            var update_comment_id = $(this).val();
            console.log(update_comment_id);
            //$("#update_comment_id").val(update_comment_id);
            $('#updateCommentModal').modal('show');

            $.ajax({
              type: "GET",
              url: "/edit-comment/"+update_comment_id,
              success: function (response) {
                console.log(response);
                $('#comment').val(response.comment.comment);
                $("#update_comment_id").val(update_comment_id);
              }
            });       
          });
      });

    </script>
    
@endsection