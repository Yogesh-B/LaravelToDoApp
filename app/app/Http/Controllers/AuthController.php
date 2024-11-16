<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailureResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            return new FailureResponse(
                ["incorrect email or password"],
                "Invalid credentials", 
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->responseWithToken($token,'Login successful');
    }
    

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($validated);

        $token = Auth::login($user);

        return $this->responseWithToken($token,'Registration successful'); 
    }
    

    public function logout(){
        Auth::logout();
        return new SuccessResponse(null,'Logout successful',Response::HTTP_OK);
    }


    public function refresh(){
        //TODO: complete the AuthController as soon as possible
    }



    public function responseWithToken($token,$message){
        //NOTE: not used response resource because 
        //wanted to show authorization variables directly 
        //in response
        //UPGRADABLE
        return response()->json([
            'success' => true,
            'message'=>$message,
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
        ],200);
    }

}
