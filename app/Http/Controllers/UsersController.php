<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UsersController extends Controller
{
    //fetch the user details
    public function getAuthUser(Request $request){
        return response()->json(auth()->user());
    }

    // delete the user
    public function deleteUser(Request $request){
        $user = User::findorfail(Auth::id());
        if($user){
            $user->delete();
            return response()->json([
                    'message' => 'User deleted sucessfully' 
            ],200);
        }
        else{
            return response()->json([
                "message" => "User not found"
              ], 404);
        }
    }
    // update the user
    public function updateUser(Request $request){
        $validator = Validator::make($request->all(), [
            // validate incoming Request
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'E-mail', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        };
        // find and update the user
        $user = User::findorfail(Auth::id());
        $data = $request->all();
        if($user){
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            return response()->json([
                'message' => 'user updated successfully'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
    }
}
