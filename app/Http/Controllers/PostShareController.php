<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('post.shared')
        //     ->with('posts', Post::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get());

        // $posts = Post::withOnly('shares')->get();
        // return view('post.shared')->with('posts', $posts);

        $posts = Post::with(['shares' => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        }])->get();

        return view('post.shared')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('otheruser.sharedposts')
                ->with('user', User::where('id', $id)->orderBy('updated_at', 'DESC')->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function edit(Share $share)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Share $share)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shared = Share::find($request->delete_shared_id);
        $shared->delete();

        return redirect()->back()->with('status', 'Shared post deleted successfully!');
    }
}
