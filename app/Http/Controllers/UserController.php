<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
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
        //
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
        return view('user.editprofile')->with('user', User::where('id', $id)->first());
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
            User::where('id', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'middle_name' => $request->input('mname'),
                    'last_name' => $request->input('lname'),
                    'date_of_birth' => $request->input('dob'),
                    'username' => $request->input('uname')
                ]);
        
        return redirect('/profile')->with('message', 'Profile Updated Successfully!');

        } else {

            $newImageName = time() . '.' . $request->uploadnewImg->extension();
            $request->uploadnewImg->move(public_path('images'), $newImageName);
    
            User::where('id', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'middle_name' => $request->input('mname'),
                    'last_name' => $request->input('lname'),
                    'date_of_birth' => $request->input('dob'),
                    'username' => $request->input('uname'),
                    'image_path' => $newImageName
                ]);
            
        return redirect('/profile')->with('message', 'Post Updated Successfully!');
        }
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
