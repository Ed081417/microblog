<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
    }

    public function changePassword()
    {
        return view('user.changePassword');
    }

    public function resetPassword(Request $request)
    {     
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $current_password = $request->input('currentPassword');
        if(Hash::check($current_password, Auth::user()->password)) 
        {
            $hashed_password = Hash::make($request->input('password'));
            $reset_password = User::find(Auth::user()->id);
            $reset_password->password = $hashed_password;
            $reset_password->save();
    
            return redirect('/change-password')->with('message', 'Password reset successfully');
        } else {
            return redirect('/change-password')->with('status', 'Current Password do not match!');
        }
        
    }

    public function changeEmail()
    {
        return view('user.changeEmail');
    }

    public function resetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc',
        ]);

        if($request->input('email') == $request->input('email_confirmation')) 
        {
            $current_password = $request->input('current_password');
            if(Hash::check($current_password, Auth::user()->password)) 
            {
                $reset_email = User::find(Auth::user()->id);
                $reset_email->email = $request->input('email');
                $reset_email->email_verified_at = null;
                $reset_email->save();
        
                // return redirect('home');
                event(new Registered($reset_email));

                Auth::login($reset_email);
                return redirect(RouteServiceProvider::HOME);

            } else {
                return redirect('/change-email')->with('status', 'Current Password do not match!');
            }
        } else {
            return redirect('/change-email')->with('status', 'New email entered do not match!');
        }
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
        //View other user profile
        return view('otheruser.profile')
                ->with('user', User::where('id', $id)->orderBy('updated_at', 'DESC')->first());

        // return view('otheruser.profile')
        //     ->with('posts', Post::orderBy('updated_at', 'DESC')->get());

   
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


    public function removeImg(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $image_location =  public_path().'/images' . '/' .Auth::user()->image_path;
        if(File::exists($image_location)) {
            File::delete($image_location);
        }

        $user->image_path = null;
        $user->save();

        return redirect()->back()->with('status', 'Image uploaded removed successfully!');
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
            $image_location =  public_path().'/images' . '/' . Auth::user()->image_path;
            if(File::exists($image_location)) {
                File::delete($image_location);

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
            } else {
                return redirect('/profile')->with('status', 'Error updating profile. Try again.');
            }
            
            
        return redirect('/profile')->with('message', 'Profile Updated Successfully!');
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
