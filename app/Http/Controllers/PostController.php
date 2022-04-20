<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
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
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'description' => ['required', 'string', 'max:500'],
        //     'image' => ['required','image', 'mimes:jpeg,png,jpg','max:5048'],
        // ]);
        
        // if($request->image == " ") {
        //     $post = new Post;
        //     $post->user_id = auth()->user()->id;
        //     $post->title = $request->input('title');
        //     $post->description = $request->input('description');
        //     $post->save();

        // } else {
        //     $newImageName = time() . '-' . $request->fname . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $newImageName);

        //     $post = new Post;
        //     $post->user_id = auth()->user()->id;
        //     $post->title = $request->input('title');
        //     $post->description = $request->input('description');
        //     $post->image_path = $newImageName;
        //     $post->save();
        // }   

        $newImageName = time() . '-' . $request->id . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->image_path = $newImageName;
        $post->save();

        return redirect()->back()->with('message', 'Post successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json([
            'status' => 200,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
