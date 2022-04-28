<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('follow.findpeople');

        // $search = $request->input('search');
        // $result = User::select("id", "first_name", "last_name", "image_path", "created_at")
        //                ->where(function ($query) use ($search) {
        //                     $query->orWhere('first_name', 'like', "%{$search}%")
        //                           ->orWhere('last_name', 'like', "%{$search}%");
        //                 })->get();
  
        // return view('user.search')->with('results', $result);
    }

    public function queryPost(Request $request)
    {

        if($request->has('search')) {
            $posts = Post::search($request->search)->get();
        } else {
            $posts = Post::get();
        }

        return view('post.search', [
            // 'results' => $result
            'posts' => $posts
        ]);
    }

    public function queryUser(Request $request)
    {

        if($request->has('searchUser')) {
            $users = User::search($request->searchUser)->get();
        } else {
            $users = User::get();
        }

        return view('user.search', [
            // 'results' => $result
            'users' => $users
        ]);
    }

}
