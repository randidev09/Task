<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login(request $request){
        $rules = [
            'username'              => 'required',
            'password'              => 'required'
        ];
  
        $messages = [
            'username.required'     => 'Username cant be blank',
            'password.required'     => 'Password cant be blank'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'code' => '300',
                'message' => 'Failed to login'
            ])->withErrors($validator);
        }

        $username   = $request->username;
        $password   = $request->password;
        $user       = User::where('username',$username)->first();
        if( ! empty($user) && Hash::check( $password, $user->password ) ){
            session()->put('userID',$user->id);
            session()->put('is_login',true);
            Session::save();
            return response()->json([
                'code' => '200',
                'message' => 'Successfully login',
                'userID' => $user->id
            ]);   
        }else{
            return response()->json([
                'code' => '404',
                'message' => 'User not found'
            ]);   
        }
    }

    public function logout(request $request){
        Session::forget('is_login');
        Session::forget('userID');
        Session::save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully logout'
        ]); 
    }
}
