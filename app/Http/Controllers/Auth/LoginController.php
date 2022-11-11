<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // login form page
    public function login()
    {
        // check user is logged in or not
        if (Auth::check()) {
            if(user()->hasRole('admin')){
                return redirect()->route('admin.dashboard');
            }elseif(user()->hasRole('customer')){
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('login')->with('error', 'Your account is not approved please contact to admin for account approval!');
            }
        }

        // redirect to this page if user not logged in
        return view('frontend.pages.auth.login');
    }

    // match credentials then logged in user
    public function credentials(Request $request)
    {
        // assign value to variables
        $email = $request->email;
        $password = $request->password;

        // check if user credentials matched then logged in and redirect to related page.
        if(Auth::attempt(['email' => $email, 'password' => $password], true))
        {
            if(user()->hasRole('admin')){
                return redirect()->route('admin.dashboard');
            }elseif(user()->hasRole('customer')){
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('login')->with('error', 'You are not authorized to logged in!');
            }
        }

        // redirect back if user credentials not matched
        return back()->with('error', 'Your credentials does not match with our record!');
    }

    // get logged out user
    public function logout(){
        if(Auth::logout()){
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
