<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Share;
use App\Traits\pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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

        $sharedPosts = Post::whereHas('shares', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->orderBy('updated_at', 'DESC')->get();
        
        $paginatedSharedPosts = $this->paginate($sharedPosts);

        return view('post.shared')->with('sharedPosts', $paginatedSharedPosts);

        //$sharedPosts = User::where('id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        // return view('post.shared')
        //     ->with('posts', Post::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get());
        //return view('post.shared')->with('user', $paginatedSharedPosts);
        

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
        $user = User::find($id);
        //$userShares = $user->shares()->paginate(5); 
        // $userShares = User::where('id', $id)->orderBy('updated_at', 'DESC')->first();
        // $paginatedShares = $user->shares();
        // return view('otheruser.sharedposts')->with('user', $paginatedShares);

        $userShares = User::where('id', $id)->orderBy('updated_at', 'DESC')->first();
        return view('otheruser.sharedposts')->with('user', $userShares);

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
