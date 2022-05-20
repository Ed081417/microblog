<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['string', 'nullable','max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'dob' => ['required', 'date', 'before:today'],
            'uname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['mimes:jpeg,png,jpg','max:5048'],
        ]);

        if ($request->mname=="" && $request->image=="") {
            $middleName = "";
            $emptyImg = null;

            $user = User::create([
                'first_name' => $request->fname,
                'middle_name' => $middleName,
                'last_name' => $request->lname,
                'date_of_birth' => $request->dob,
                'username' => $request->uname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image_path' => $emptyImg
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);   

        } elseif (is_null($request->mname)) {
            $middleName = "";
            $newImageName = time() . '-' . $request->fname . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            $user = User::create([
                'first_name' => $request->fname,
                'middle_name' => $middleName,
                'last_name' => $request->lname,
                'date_of_birth' => $request->dob,
                'username' => $request->uname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image_path' => $newImageName
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);

        } else {

            $newImageName = time() . '-' . $request->fname . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            $user = User::create([
                'first_name' => $request->fname,
                'middle_name' => $request->mname,
                'last_name' => $request->lname,
                'date_of_birth' => $request->dob,
                'username' => $request->uname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image_path' => $newImageName
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }
        
              
        
    }
}
