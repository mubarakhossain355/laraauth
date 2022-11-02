<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterStoreRequest;
use Illuminate\Support\Facades\Hash;

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

        


    }
}
