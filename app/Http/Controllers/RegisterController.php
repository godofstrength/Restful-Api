<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class RegisterController extends Controller
{
    //
    public function registerUser(Request $request){
        //validate data
       $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'E-mail', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']      
        ]);
        
        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }
        // create the user
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       

        //generate the token
        $userToken = $user->createToken('personal access client');
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
                'message' => 'Registration Successful',
            ]
        ],200);
    }


}
