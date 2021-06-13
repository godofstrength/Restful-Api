<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function Login(Request $request){
        $data = $request->only('email','password');
        // validate user
        if(Auth::attempt($data)){
            // get user
            $user = $request->user();
            // generate token
            $userToken = $user->createToken('Personal access client');
            $token = $userToken->token;
            $token->save();
            // reconstruct the user
            $userArr = [
                'name' => $user->name,
                'email' => $user->email,
                'accessToken' => $userToken->accessToken
            ];

            return response()->json([
                'data' => [
                    'user' => $userArr,
                    'message' => 'Login successful'
                ]
            ],200);
        }
        return response()->json(['error' => 'Invalid credentials'],401);

    }
}
