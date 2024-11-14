<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $token = Auth::attempt($validated);
        $user = Auth::user();

        if(!$user){
            //TODO: update failure response with proper status code
            dd("user does not exists");
        }
        //TODO: update response with status code
        return response()->json([
            'message'=>'logged in',
            'access_token'=>$token,
            'token_type'=>'bearer',
            // 'expires_in'=>auth()->factory()->getTTL()*60, //TODO: make it live longer, atleast half of daylight
        ],200);
        dd($token);

    }
    

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($validated);

        //TODO: update the response
        return response()->json([
            'message'=>'User created successfully',
            'user'=>$user
        ],201);
    }
    
    public function responseWithToken($token){
        //TODO: same response for login and refresh
    }

}
