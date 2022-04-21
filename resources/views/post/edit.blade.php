@extends('partials.layout')



@section('content')
    
    <div class="container d-flex justify-content-center">
        <div class="card w-50 mb-5 ">
            <h5 class="card-header">UPDATE POST</h5>
            <div class="card-body">
                <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">        
                    @csrf
                    @method('PUT')
            
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" value="{{ $post->title }}" id="title" >
                    </div>
        
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="5">{{ $post->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Image uploaded:</label>
                        <img src="{{asset('images/' . $post->image_path)}}" alt="..." class="img-fluid">               
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Choose New Image:</label>
                        <input type="file" class="form-control" accept="image/*" id="uploadnewImg" >
                        <img id="newImg" class="img-fluid">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-end">Update</button>
                    </div>
                    
                </form>
            </div>
            <div class="card-footer">    
                <small class="text-muted"><span>Posted on {{ date("F j, Y", strtotime( $post->created_at)) }} </span></small>
            </div>
            
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
   
        //Image upload preview
        uploadnewImg.onchange = evt => {
            const [file] = uploadnewImg.files
            if (file) {
                newImg.src = URL.createObjectURL(file)
            }
        }
     

    </script>
    
@endsection