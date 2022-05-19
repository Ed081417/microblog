@extends('partials.layout')



@section('content')
    
    <div class="container d-flex justify-content-center">

        

        <div class="card w-50 mb-5 ">
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
            
            <h5 class="card-header">UPDATE POST</h5>
            <div class="card-body">
                <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">        
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" value="{{ $post->title }}" name="title" >
                        @error('title')
                            <span style="color: red;">*Title is required!</span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="5">{{ $post->description }}</textarea>
                        @error('description')
                            <span style="color: red;">*Description is required and minimum of 140 characters!</span>
                        @enderror
                    </div>

                    @if (is_null($post->image_path))
                        <div class="mb-3">
                            <label for="description" class="form-label">Image uploaded: No image uploaded.</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Image:</label>
                            <input type="file" class="form-control" accept="image/*" name="uploadnewImg" id="uploadnewImg" >
                            @error('uploadnewImg')
                                <span style="color: red;">*Image should be of type *.jpg, *.jpeg, *.png only.</span>
                            @enderror
                            <img id="newImg" class="img-fluid">
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="description" class="form-label">Image uploaded:</label>
                            <img src="{{asset('images/' . $post->image_path)}}" alt="..." class="img-fluid">   
                            
                        </div> 

                        <div class="mb-3">
                            <label class="form-label">Upload New Image:</label>
                            <input type="file" class="form-control" accept="image/*" name="uploadnewImg" id="uploadnewImg" >
                            @error('uploadnewImg')
                                <span style="color: red;">*Image should be of type *.jpg, *.jpeg, *.png only.</span>
                            @enderror
                            <img id="newImg" class="img-fluid">
                        </div>
                    @endif
                
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-end">Update</button>
                        <button class="btn btn-warning clearImg">Clear Image</button>                  
                    </div>
                    
                </form>

                <form action="{{ route('remove-image') }}" method="POST">
                    @csrf
                    @method('PUT')

                    
                    @if ($post->image_path != "")
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-danger" >Remove image uploaded.</button>
                    @else
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                    @endif
                    
                </form>
            </div>
            
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            //Image upload preview
            uploadnewImg.onchange = evt => {
                const [file] = uploadnewImg.files
                if (file) {
                    newImg.src = URL.createObjectURL(file)
                }
            }

            //Clear input image field
            $('.clearImg').click(function (e) {
                e.preventDefault();
                $("#uploadnewImg").val('');
                document.getElementById('newImg').src = ""

                //$("#uploadedImg").remove();
                //$("#uploadedImg").src = "#";
                // $('#postModal').modal('show');
            });
        });

    </script>
    
@endsection