<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterStoreRequest;

class CustomRegisterController extends Controller
{
    public function registerformshow(){
        return view('custom_auth.register');
    }

    public function registerUser(RegisterStoreRequest $request){
        // user create
        User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'phone' =>$request->phone,
            'password'=>Hash::make($request->password)
        ]);

        // make credentials array

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //login attempt if success then redirect home

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        // Return with error message

        return back()->withErrors([
            'email' => 'Wrong Credentials Email'
        ])->onlyInput('email');


    }

    public function loginformShow(){
        return view('custom_auth.login');
    }


    public function loginUser(LoginUserRequest $request){
        //dd($request->all());
        // make credentials array

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //login attempt if success then redirect home

        if(Auth::attempt($credentials,$request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        // Return with error message

        return back()->withErrors([
            'email' => 'Wrong Credentials Email'
        ])->onlyInput('email');


    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }
}
