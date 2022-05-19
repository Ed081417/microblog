<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Share;
use App\Traits\pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostShareController extends Controller
{
    use pagination;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersShares = User::where('id', Auth::user()->id)->orderBy('updated_at', 'DESC')->first();
        $trashedPosts = Post::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        $sharedPosts = Share::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->paginate(5);

        return view('post.shared', compact('sharedPosts'))->with('user', $usersShares)->with('trashedPosts', $trashedPosts);       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $share = new Share;
        $share->post_id = $request->input('share_post_id');
        $share->user_id = auth()->user()->id;
        $share->save();

        return redirect()->back()->with('message', 'Post shared successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Share $share
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usersShares = User::where('id', $id)->orderBy('updated_at', 'DESC')->first();
        $trashedPosts = Post::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        $users = Share::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(5);

        return view('otheruser.sharedposts', compact('users'))->with('user', $usersShares)->with('trashedPosts', $trashedPosts);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Share $sharedpost)
    {
        $this->authorize('delete', $sharedpost);

        $shared = Share::find($sharedpost->id);
        $shared->delete();

        return redirect()->back()->with('status', 'Shared post deleted successfully!');
    }
}
