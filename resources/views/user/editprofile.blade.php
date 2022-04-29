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
            <h5 class="card-header">UPDATE PROFILE</h5>
            <div class="card-body">
                <form action="/profile/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">        
                    @csrf
                    @method('PUT')
            
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->first_name }}" name="fname" >
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->middle_name }}" name="mname" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->last_name }}" name="lname" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth </label>
                        <input type="date" class="form-control" value="{{ Auth::user()->date_of_birth }}" name="dob" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->username }}" name="uname" >
                    </div>

                    @if (is_null(Auth::user()->image_path))
                        <div class="mb-3">
                            <label for="description" class="form-label">Image uploaded: Default Image.</label>
                            <img src="{{asset('images/default.png')}}" alt="..." class="img-fluid">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Image:</label>
                            <input type="file" class="form-control" accept="image/*" name="uploadnewImg" id="uploadnewImg" >
                            <img id="newImg" class="img-fluid">
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="description" class="form-label">Image uploaded:</label>
                            <img src="{{asset('images/' . Auth::user()->image_path)}}" alt="..." class="img-fluid">   
                            
                        </div> 

                        <div class="mb-3">
                            <label class="form-label">Upload New Image:</label>
                            <input type="file" class="form-control" accept="image/*" name="uploadnewImg" id="uploadnewImg" >
                            <img id="newImg" class="img-fluid">
                        </div>
                    @endif

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-end">Update</button>
                    </div>
                    
                </form>

                <form action="{{ route('remove-profileImg') }}" method="POST">
                    @csrf
                    @method('PUT')

                    
                    @if (Auth::user()->image_path != "")
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-danger" >Remove image uploaded.</button>
                    @else
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endif
                    
                </form>
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