@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md">
                @include('partials.profilesidebar')
            </div>


            <div class="col-md-6">
                
                <h1 class="display-6">Following - {{ $user->followings->count() }}</h1>
                
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
                        @forelse ($users->sortDesc() as $following)        
                                
                            <tr>
                                <td>
                                    <h5>{{ $following->first_name . ' ' . $following->last_name }}</h5>
                                </td>
                                <td>
                                    <a href="/user/{{ $following->id }}/profile" value="{{ $following->id }}" 
                                        type="button" class="btn btn-sm btn-primary">View Profile</a>
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-danger btn-sm">Remove Follower</button>
                                </td> --}}
                            </tr>
                        
                        @empty
                            <div class="card-body">
                                <h1 class="display-6">No followings yet.</h1>

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
                    {{-- <div class="card text-white bg-primary" >
                        <div class="card-header">Follow other People</div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}  
                            <a type="button" class="btn btn-primary btn-sm " href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        <li class="list-group-item">Monkey D. Luffy
                            <a type="button" class="btn btn-primary btn-sm" href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        <li class="list-group-item">Roronoa Zoro
                            <a type="button" class="btn btn-primary btn-sm" href="#"><i class="bi bi-plus"></i>Follow</a>
                        </li>
                        </ul>
                    </div> --}}
                    </div>
                </div>
                </div>          
            </div>
            {{-- Followers --}}
        </div>
    </div>

@endsection