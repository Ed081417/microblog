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
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'uname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg','max:5048'],
        ]);

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
