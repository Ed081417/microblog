<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    }

    public function queryPost(Request $request)
    {
        $request->validate(
            [
            'search' => ['required', 'string']
            ]
        );

        if ($request->has('search')) {
            $posts = Post::search($request->search)->orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $posts = Post::paginate(3);
        }

        return view(
            'post.search', [
            'posts' => $posts
            ]
        );
    }

    public function queryUser(Request $request)
    {
        $request->validate(
            [
            'searchUser' => ['required', 'string']
            ]
        );

        if ($request->has('searchUser')) {
            $users = User::search($request->searchUser)->orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $users = User::paginate(3);
        }

        return view(
            'user.search', [
            'users' => $users
            ]
        );
    }

}
