<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    protected function register_form()
    {
        return view('frontend.pages.auth.register');
    }

    protected function register(Request $req)
    {
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'mobile_number' => $req->mobile_number,
            'password' => Hash::make($req->password),
        ]);

        $user->assignRole('Vendor');

        // assign value to variables
        $email = $req->email;
        $password = $req->password;

        // check if user credentials matched then logged in and redirect to related page.
        if(Auth::attempt(['email' => $email, 'password' => $password], true))
        {
            return redirect()->route('vendor.dashboard');
        }else{
            return redirect()->route('login')->with('error', 'Something went wrong please try again!');
        }
    }
}
