<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');
        // $result = DB::table('users')
        //                 ->where(function ($query) use ($search) {
        //                     $query->orWhere('users.first_name', 'like', "%{$search}%")
        //                           ->orWhere('users.last_name', 'like', "%{$search}%");
        //                 })
        //                 ->join('posts', 'users.id', '=', 'posts.user_id')
        //                 ->select('users.*', 'posts.*')->get();

        $search = $request->input('search');
        $result = User::select("id", "first_name", "last_name", "image_path", "created_at")
                       ->where(function ($query) use ($search) {
                            $query->orWhere('first_name', 'like', "%{$search}%")
                                  ->orWhere('last_name', 'like', "%{$search}%");
                        })->get();
  
        return view('user.search')->with('results', $result);
    }

}
