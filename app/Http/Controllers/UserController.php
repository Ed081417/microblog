<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $request->validate(
            [
            'currentPassword' => 'required',
            'password' => 'required|min:8|confirmed',
            ]
        );

        $currentPassword = $request->input('currentPassword');
        if (Hash::check($currentPassword, Auth::user()->password)) {
            $hashedPassword = Hash::make($request->input('password'));
            $resetPassword = User::find(Auth::user()->id);
            $resetPassword->password = $hashedPassword;
            $resetPassword->save();
    
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
        $request->validate(
            [
            'current_password' => 'required',
            'email' => 'required|email:rfc',
            ]
        );

        if ($request->input('email') == $request->input('email_confirmation')) {
            $currentPassword = $request->input('current_password');
            if (Hash::check($currentPassword, Auth::user()->password)) {
                $resetEmail = User::find(Auth::user()->id);
                $resetEmail->email = $request->input('email');
                $resetEmail->email_verified_at = null;
                $resetEmail->save();

                event(new Registered($resetEmail));
                Auth::login($resetEmail);
                return redirect(RouteServiceProvider::HOME);

            } else {
                return redirect('/change-email')->with('status', 'Current Password do not match!');
            }
        } else {
            return redirect('/change-email')->with('status', 'New email entered do not match!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->orderBy('updated_at', 'DESC')->first();
        $userPosts=User::find($id);
        $users = $userPosts->posts()->orderBy('updated_at', 'DESC')->paginate(5);

        return view('otheruser.profile', compact('users'))->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        return view('user.editprofile')->with('user', User::where('id', Auth::user()->id)->firstOrFail());
    }


    public function removeImg()
    {
        $user = User::find(Auth::user()->id);
        $imageLocation =  public_path().'/images' . '/' .Auth::user()->image_path;
        if (File::exists($imageLocation)) {
            File::delete($imageLocation);
        }

        $user->image_path = null;
        $user->save();

        return redirect()->back()->with('status', 'Image uploaded removed successfully!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'fname' => ['required', 'string', 'max:150'],
            'mname' => ['string', 'nullable','max:150'],
            'lname' => ['required', 'string', 'max:150'],
            'dob' => ['required', 'date', 'before:today'],
            'uname' => ['required', 'alpha_num', 'string', 'max:150'],
            'uploadnewImg' => ['mimes:jpg,jpeg,png', 'max:5048']

            ]
        );


        if ($request->uploadnewImg=="" && $request->mname !=="") {
            User::where('id', $id)
                ->update(
                    [
                    'first_name' => $request->input('fname'),
                    'middle_name' => $request->input('mname'),
                    'last_name' => $request->input('lname'),
                    'date_of_birth' => $request->input('dob'),
                    'username' => $request->input('uname')
                    ]
                );
        
            return redirect('/profile')->with('message', 'Profile Updated Successfully!');

        } elseif ($request->mname =="" && $request->uploadnewImg!=="") {
            $middleName = "";
            $imageLocation =  public_path().'/images' . '/' . Auth::user()->image_path;
            if(File::exists($imageLocation)) {
                File::delete($imageLocation);

                $newImageName = time() . '.' . $request->uploadnewImg->extension();
                $request->uploadnewImg->move(public_path('images'), $newImageName);
        
                User::where('id', $id)
                    ->update(
                        [
                        'first_name' => $request->input('fname'),
                        'middle_name' => $middleName,
                        'last_name' => $request->input('lname'),
                        'date_of_birth' => $request->input('dob'),
                        'username' => $request->input('uname'),
                        'image_path' => $newImageName
                        ]
                    );
            } else {
                return redirect('/profile')->with('status', 'Error updating profile. Try again.');
            }
    
            return redirect('/profile')->with('message', 'Profile updated successfully!');

        } elseif ($request->uploadnewImg=="" && $request->mname =="") {
            $middleName = "";
            User::where('id', $id)
                ->update(
                    [
                    'first_name' => $request->input('fname'),
                    'middle_name' => $middleName,
                    'last_name' => $request->input('lname'),
                    'date_of_birth' => $request->input('dob'),
                    'username' => $request->input('uname')
                    ]
                );
        
            return redirect('/profile')->with('message', 'Profile Updated Successfully!');
    
   
        } else {
            $imageLocation =  public_path().'/images' . '/' . Auth::user()->image_path;
            if(File::exists($imageLocation)) {
                File::delete($imageLocation);

                $newImageName = time() . '.' . $request->uploadnewImg->extension();
                $request->uploadnewImg->move(public_path('images'), $newImageName);
        
                User::where('id', $id)
                    ->update(
                        [
                        'first_name' => $request->input('fname'),
                        'middle_name' => $request->input('mname'),
                        'last_name' => $request->input('lname'),
                        'date_of_birth' => $request->input('dob'),
                        'username' => $request->input('uname'),
                        'image_path' => $newImageName
                        ]
                    );
            } else {
                return redirect('/profile')->with('status', 'Error updating profile. Try again.');
            }
            
            
            return redirect('/profile')->with('message', 'Profile Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
