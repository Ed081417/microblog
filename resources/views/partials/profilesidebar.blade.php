<div class="card " style="max-width: 18rem;" >
    @if (is_null($user->image_path))
        <a href="/user/{{ $user->id }}/profile">
            <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="...">
        </a>
    @else
        <a href="/user/{{ $user->id }}/profile">
            <img src="{{ asset('images/' . $user->image_path) }}" class="card-img-top" alt="...">
        </a>
    @endif
    
    @if ($user->middle_name=="")
        <h4 class="fs-4" style="text-align: center;">{{ $user->first_name . ' ' .  $user->last_name}}</h4>
    @else
      <div class="card-header">
        <h4 class="fs-4" style="text-align: center;">
            {{ $user->first_name . ' ' . $user->middle_name . ' ' .  $user->last_name}}</h4>
      </div>
    @endif
    
    <div class="card-body">
        @if (Auth::user()->id != $user->id)
            @if (!$user->followedBy(auth()->user()))
                <form action="{{ route('follow', $user) }}" method="POST" class="d-flex justify-content-center">
                    @csrf

                    {{-- <input type="hidden" name="follow" value="{{ $user->id }}"> --}}
                    <button type="submit" class="btn btn-primary">FOLLOW</button>
                </form>

            @else
                <div class="container d-flex justify-content-center">
                    <button type="submit" value="{{ $user->id }}" class="btn btn-secondary unfollowBtn">UNFOLLOW</button>
                </div>
                    
            @endif

            <ul class="list-group mt-2">
                <li class="list-group-item active" aria-current="true">PROFILE</li>

                <a href="/user/{{ $user->id }}/profile" class="list-group-item list-group-item-action">Posts</a>

                <a href="/user/{{ $user->id }}/shared" class="list-group-item list-group-item-action">Shared Posts</a>

                <a href="/profile/{{ $user->id }}/followers" class="list-group-item d-flex justify-content-between align-items-start">
                    Followers:<span class="badge bg-primary rounded-pill">{{  $user->followers->count() }}</span></a>
                
                <a href="/profile/{{ $user->id }}/followings" class="list-group-item d-flex justify-content-between align-items-start">
                    Followings:<span class="badge bg-primary rounded-pill">{{  $user->followings->count() }}</span></a>
        
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    Birthdate:<span class="badge bg-primary rounded-pill">
                        {{ date("F j, Y", strtotime( $user->date_of_birth)) }}</span></li>

                <li class="list-group-item d-flex justify-content-between align-items-start">
                    Date Joined:<span class="badge bg-primary rounded-pill">
                        {{ date("F j, Y", strtotime( $user->created_at)) }}</span></li>

                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <span class="badge bg-primary rounded-pill">{{  $user->email }}</span></li>
            </ul>
        

        @else    
            <div class="list-group">
                <a href="{{ route('user-posts') }}" class="list-group-item list-group-item-action ">Posts</a>
                <a href="/user/{{ $user->id }}/shared" class="list-group-item list-group-item-action">Shared Posts</a>
                <a href="{{ route('followers') }}" 
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    Followers<span class="badge bg-primary rounded-pill">{{ Auth::user()->followers->count() }}</span></a>
    
                <a href="{{ route('followings') }}" 
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    Following<span class="badge bg-primary rounded-pill">{{ Auth::user()->followings->count() }}</span></a>
    
                <a href="{{ route('find-people') }}" class="list-group-item list-group-item-action">Find People</a>
            </div>
        @endif
    </div>
</div>