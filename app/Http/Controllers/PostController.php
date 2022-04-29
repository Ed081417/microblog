<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // $posts = Post::whereIn('user_id', function($query)
        // {       
        //     $query->select('user_id')
        //             ->from('followers')
        //             ->where('follower_id', Auth::user()->id);
        // })->orWhere('user_id', Auth::user()->id)
        //     ->with('user')
        //     ->orderBy('updated_at', 'DESC')->get();

        // return view('home')->with('posts', $posts);

        $posts = Post::whereIn('user_id', function($followed)
        {       
            $followed->select('user_id')
                    ->from('followers')
                    ->where('follower_id', Auth::user()->id);
        })->orwhereIn('user_id', function($shared)
            {       
                $shared->select('user_id')
                        ->from('shared_posts')
                        ->where('user_id', Auth::user()->id);
            })->orWhere('user_id', Auth::user()->id)

            ->with('user')
            ->orderBy('updated_at', 'DESC')->get();

        return view('home')->with('posts', $posts);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('post.userposts')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->image==""){
            $post = new Post;
            $post->user_id = auth()->user()->id;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->save();

            return redirect()->back()->with('message', 'Posted Successfully!');

        } else {
            $newImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            $post = new Post;
            $post->user_id = auth()->user()->id;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->image_path = $newImageName;
            $post->save();

            return redirect()->back()->with('message', 'Posted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('post.view')->with('post', Post::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('post.edit')->with('post', Post::where('id', $id)->first());
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
        if($request->uploadnewImg==""){
            Post::where('id', $id)
            ->update([
                'user_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);
        
        return redirect('/home')->with('message', 'Post Updated Successfully!');

        } else {

            $newImageName = time() . '.' . $request->uploadnewImg->extension();
            $request->uploadnewImg->move(public_path('images'), $newImageName);
    
            Post::where('id', $id)
                ->update([
                    'user_id' => auth()->user()->id,
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'image_path' => $newImageName,
                ]);
            
            return redirect('/home')->with('message', 'Post Updated Successfully!');
        }
        
    }


    public function removeImg(Request $request)
    {
        $post = Post::find($request->input('post_id'));
        $image_location =  public_path().'/images' . '/' .$post->image_path;
        if(File::exists($image_location)) {
            File::delete($image_location);
        }

        $post->image_path = null;
        $post->save();

        return redirect()->back()->with('status', 'Image uploaded removed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $post = Post::find($request->delete_post_id);
        if($post->image_path != "") {
            $image_location =  public_path().'/images' . '/' .$post->image_path;
            if(File::exists($image_location)) {
                File::delete($image_location);
            }
            $post->delete();

            return redirect()->back()->with('status', 'Post deleted successfully!');
        } else {
            $post = Post::find($request->delete_post_id);
            $post->delete();
    
            return redirect()->back()->with('status', 'Post deleted successfully!');
    
        }
       
    }
}
