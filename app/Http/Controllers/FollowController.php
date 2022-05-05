<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class FollowController extends Controller
{
    /** Paginate collection.
    *   @param array|Collection $items
    *   @param int $perPage
    *   @param int $page
    *   @param array $options
    *   @return LengthAwarePaginator
    */
    public function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('otheruser.profile');
    }

    public function followerList()
    {   
      

        $users = User::orderBy('created_at', 'DESC')->get();
        //$paginateFollowers =  $this->paginate($users);
        
        return view('follow.followers')->with('users',  $users);
    }

    public function followingList()
    {
        return view('follow.followings')->with('users', User::orderBy('created_at', 'DESC')->get());
    }

    public function profileFollowers($id)
    {
        return view('otheruser.followers')
                ->with('user', User::where('id', $id)->orderBy('created_at', 'DESC')->first());
    }

    public function profileFollowings($id)
    {
        return view('otheruser.followings')
                ->with('user', User::where('id', $id)->orderBy('created_at', 'DESC')->first());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {

        $user->follows()->create([
            'follower_id' => $request->user()->id,
        ]);


        return redirect()->back()->with('message', 'Followed Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $follow = Follow::where('user_id', $request->unfollow_user_id)->where('follower_id', $request->user()->id);
        $follow->delete();

        return redirect()->back()->with('status', 'Unfollowed Successfully!');
    }
}
