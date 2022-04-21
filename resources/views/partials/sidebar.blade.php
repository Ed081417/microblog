{{-- Sidebar --}}

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary" style="width: 280px;">
    <a href="#"> <img src="{{ asset('images/' . Auth::user()->image_path) }}" alt="..." class="img-thumbnail"> </a>
    <span class="fs-4" style="text-align: center;">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
    <li>
        <a href="{{ route('user-posts') }}" class="nav-link text-white">
        Posts
        </a>
    </li>
    <li>
        <a href="#" class="nav-link text-white">  
        Followers
        </a>
    </li>
    </ul>
    <hr>

</div>

  {{-- Sidebar --}}