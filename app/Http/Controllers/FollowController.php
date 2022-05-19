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

    /**
     * Display follower list of Authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function followerList()
    {     
        $followers = User::find(Auth::user()->id);
        $users = $followers->followers()->paginate(3);

        return view('follow.followers', compact('users'));
    }

    /**
     * Display following list of Authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function followingList()
    {
        $followings = User::find(Auth::user()->id);
        $users = $followings->followings()->paginate(3);

        return view('follow.followings', compact('users'));
    }

    /**
     * Display follower list of other user.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileFollowers($id)
    {
        $user = User::where('id', $id)->orderBy('created_at', 'DESC')->first();
        $profilefollowers = User::find($id);
        $users = $profilefollowers->followers()->paginate(3);

        return view('otheruser.followers', compact('users'))->with('user', $user);
    }

    /**
     * Display following list of other user.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileFollowings($id)
    {
        $user = User::where('id', $id)->orderBy('created_at', 'DESC')->first();
        $profilefollowings = User::find($id);
        $users = $profilefollowings->followings()->paginate(3);

        return view('otheruser.followings', compact('users'))->with('user', $user);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {

        $user->follows()->create(
            [
            'follower_id' => $request->user()->id,
            ]
        );

        return redirect()->back()->with('message', 'Followed Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $follow = Follow::where('user_id', $request->unfollow_user_id)->where('follower_id', $request->user()->id);
        $follow->delete();

        return redirect()->back()->with('status', 'Unfollowed Successfully!');
    }
}
