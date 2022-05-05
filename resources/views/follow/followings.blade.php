@extends('partials.layout')



@section('content')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md">
                @include('partials.sidebar')
            </div>


            <div class="col-md-6">
                
                <h1 class="display-6">Following - {{ Auth::user()->followings->count() }}</h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Date followed</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                    </thead>

                    {{-- @foreach ($users as $user)
                        @foreach ($user->follows as $following)        
                            @if ( Auth::user()->id == $following->follower_id )
                                <tbody>
                                    <tr>
                                        <td>{{ $following->user->first_name . ' ' . $following->user->last_name }}</td>
                                        <td>{{ date("F j, Y", strtotime( $following->created_at)) }}</td>
                                        <td>Remove</td>
                                    </tr>
                                </tbody>
                            @endif  
                        @endforeach                  
                    @endforeach    --}}
                    <tbody>                                
                        @forelse (Auth::user()->followings->sortDesc() as $following)        
                            
                            <tr>
                                <td>
                                    <a href="/user/{{ $following->id }}/profile" value="{{ $following->id }}">
                                        {{ $following->first_name . ' ' . $following->last_name }}</a>
                                </td>
                                <td>
                                    {{ date("F j, Y", strtotime( $following->created_at)) }}
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-secondary btn-sm">Unfollow</button>
                                </td> --}}
                            </tr>
                        
                        @empty
                            <div class="card-body">
                                <h1 class="display-6">Follow other people.</h1>
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