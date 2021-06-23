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

        return 'berhasil save';
    }

    public function update(request $request, $id){
        $user           = User::find($id);
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return 'berhasil update';
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return 'berhasil hapus';
    }
}
