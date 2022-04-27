<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
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
        // return view('follow.followers')->with('followers', User::orderBy('updated_at', 'DESC' )->get());
        return view('follow.followers')->with('users', User::orderBy('updated_at', 'DESC')->get());
    }

    public function followingList()
    {
        return view('follow.followings')->with('users', User::orderBy('updated_at', 'DESC')->get());
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
