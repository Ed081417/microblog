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
                        <th scope="col">Date followed</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @forelse (Auth::user()->followers->sortDesc() as $follower)        
                                
                            <tr>
                                <td>
                                    <a href="/user/{{ $follower->id }}/profile" value="{{ $follower->id }}">
                                        {{ $follower->first_name . ' ' . $follower->last_name }}</a>
                                </td>
                                <td>
                                    {{ date("F j, Y", strtotime( $follower->created_at)) }}
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
                  
            </div>

            {{-- Followers --}}
            <div class="col-md">           
                <div class="container">
                <div class="row ">
                    <div class="col">
                    <div class="card text-white bg-primary" >
                        <div class="card-header">Suggested People</div>
                        <ul class="list-group list-group-flush">

                            @forelse ($users as $user)
                                <a href="/user/{{ $user->id }}/profile" class="list-group-item">{{ $user->first_name . ' ' .  $user->last_name}} 
                                </a>
                            @empty
                                <h3>No suggested people</h3>
                            @endforelse
        
                        </ul>
                    </div>
                    </div>
                </div>
                </div>          
            </div>
            {{-- Followers --}}
        </div>
    </div>

@endsection