{{-- Sidebar --}}
<div class="col-md">
  <div class="card " style="max-width: 18rem;" >
    @if (is_null(Auth::user()->image_path))
      <a href="{{ route('user-posts') }}">
        <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="...">
      </a>
    @else
      <a href="{{ route('user-posts') }}">
        <img src="{{ asset('images/' . Auth::user()->image_path) }}" class="card-img-top" alt="...">
      </a> 
    @endif

    @if (Auth::user()->middle_name=="")
      <div class="card-header">
        <h4 class="fs-4" style="text-align: center;">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}</h4>
      </div>
    @else
      <div class="card-header">
        <h4 class="fs-4" style="text-align: center;">
            {{ Auth::user()->first_name . ' ' .  Auth::user()->middle_name . ' ' .  Auth::user()->last_name}}</h4>
      </div>
    @endif

    <div class="card-body">
      <div class="list-group">
        <a href="{{ route('user-posts') }}" class="list-group-item list-group-item-action ">Posts</a>

        <a href="{{ route('shared-posts') }}" class="list-group-item list-group-item-action">Shared Posts</a>

        <a href="{{ route('followers') }}" 
          class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
              Followers<span class="badge bg-primary rounded-pill">{{ Auth::user()->followers->count() }}</span></a>

        <a href="{{ route('followings') }}" 
          class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
              Following<span class="badge bg-primary rounded-pill">{{ Auth::user()->followings->count() }}</span></a>

        <a href="{{ route('find-people') }}" class="list-group-item list-group-item-action">Find People</a>
      </div>
      <hr>
    </div>

  </div>
</div>
{{-- Sidebar --}}









{{-- First Side Bar --}}
{{-- Sidebar --}}
{{-- <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary" style="width: 280px;">
    <a href="{{ route('user-posts') }}"> <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="img-thumbnail"> </a>
    <span class="fs-4" style="text-align: center;">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="{{ route('user-posts') }}" class="nav-link text-white">
                Posts
            </a>
        </li>
        <li>
            <a href="{{ route('followers') }}" class="nav-link text-white">  
                Followers
            </a>
        </li>
        <li>
            <a href="{{ route('followings') }}" class="nav-link text-white">  
                Following
            </a>
        </li>
        <li>
            <a href="{{ route('find-people') }}" class="nav-link text-light">  
              Find People
            </a>
        </li>
    </ul>
    <hr>

</div> --}}
  {{-- Sidebar --}}