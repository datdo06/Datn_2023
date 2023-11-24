<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(PostLoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            if(auth()->user()->role === 'Customer'){
                return redirect()->route('home');
            }else{
                return redirect('dashboard')->with('success', 'Welcome ' . auth()->user()->name);
            }
        }
        return redirect()->route('login')->with('failed', 'Incorrect email / password');
    }

    public function logout()
    {
        $name = auth()->user()->name;
        Auth::logout();
        return redirect()->route('home');
    }



    public function register()
    {

    }

}
