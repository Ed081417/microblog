@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md">
                @include('partials.sidebar')
            </div>


            <div class="col-md-6">
                
                <h1 class="display-6">Followers - {{ Auth::user()->followers->count() }}</h1>
                
                <hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Action</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users->sortDesc() as $follower)        
                                
                            <tr>
                                <td>
                                    <h5>{{ $follower->first_name . ' ' . $follower->last_name }}</h5>
                                    {{-- <a href="/user/{{ $follower->id }}/profile" value="{{ $follower->id }}">
                                        {{ $follower->first_name . ' ' . $follower->last_name }}</a> --}}
                                </td>
                                <td>
                                    <a href="/user/{{ $follower->id }}/profile" value="{{ $follower->id }}" 
                                        type="button" class="btn btn-sm btn-primary">View Profile</a>
                                    {{-- {{ date("F j, Y", strtotime( $follower->follows->created_at)) }} --}}
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-danger btn-sm">Remove Follower</button>
                                </td> --}}
                            </tr>
                        
                        @empty
                            <div class="card-body">
                                <h1 class="display-6">You have no followers yet.</h1>

                            </div>
                        @endforelse            
                    </tbody>                       
                </table> 
                
                {{ $users->links() }}
                  
            </div>

            {{-- Followers --}}
            <div class="col-md">           
                <div class="container">
                <div class="row ">
                    <div class="col">
                        {{-- <div class="card" >
                            <div class="list-group list-group-flush">
                              <li class="list-group-item  active">Suggested People</li>
                                @forelse ($notFollowers as $notFollower)
                                    
                                        <a href="/user/{{ $notFollower->id }}/profile" class="list-group-item list-group-item-action">
                                            {{ $notFollower->first_name . ' ' .  $notFollower->last_name}}</a>
                         
                                        <a href="/user/{{ $notFollower->user->id }}/profile" class="list-group-item list-group-item-action">
                                            {{ $notFollower->first_name . ' ' .  $notFollower->last_name}}</a>

                                   
                                @empty
                                      <h4>No suggested people yet.</h4>
                                @endforelse
                            </div>
                                         
                        </div> --}}
                    </div>
                </div>
                </div>          
            </div>
            {{-- Followers --}}
        </div>
    </div>

@endsection