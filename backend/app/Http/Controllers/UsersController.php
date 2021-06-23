<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        return User::all();
    }

    public function create(request $request){
        $user           = new User;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully create user'
        ]);
    }

    public function update(request $request, $id){
        $username = $request->username;
        $email    = $request->email;
        $phone    = $request->phone;

        $user           = User::find($id);
        $user->username = $username;
        $user->email    = $email;
        $user->phone    = $phone;
        $user->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully update user',
            'user' => $user
        ]);
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully delete user'
        ]);
    }
}
