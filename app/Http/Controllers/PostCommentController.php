<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        $request->validate(
            [
            'comment' => ['required', 'string', 'max:140']
            ]
        );

        $post->comments()->create(
            [
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment'),
            ]
        );

        return redirect()->back()->with('message', 'Comment Posted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $userComment = Comment::find($id);

        return response()->json(
            [
            'status' => 200,
            'comment' => $userComment,
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Comment      $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(
            [
            'updateComment' => ['required', 'string', 'max:140']
            ]
        );

        $comment = Comment::find($comment->id);
        $comment->comment = $request->input('updateComment');
        $comment->update();

        return redirect()->back()->with('message', 'Comment Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request  
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $userComment = Comment::find($comment->id);
        $userComment->delete();

        return redirect()->back()->with('status', 'Comment deleted successfully!');
        
    }
}
