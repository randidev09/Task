<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;
use App\Models\FavouriteCompany;

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

    public function myFavouriteCompany($id){
        $companies = DB::table('company as c')
                    ->join('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                    ->join('user as u', 'u.id', '=', 'f.userID')
                    ->select('c.*')
                    ->where('u.id','=',$id)
                    ->get();

        return response()->json([
            'code' => '200',
            'companies' => $companies
        ]);
    }

    public function addFavourite(request $request){
        $userID     = $request->userid;
        $companyID  = $request->companyid;
        
        $favourite              = new FavouriteCompany();
        $favourite->userID      = $userID;
        $favourite->companyID   = $companyID;
        $favourite->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully added to favourite'
        ]);
    }

    public function deleteFavourite(request $request){
        $userID     = $request->userid;
        $companyID  = $request->companyid;
        $companies = DB::table('company as c')
                    ->join('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                    ->join('user as u', 'u.id', '=', 'f.userID')
                    ->select('c.*')
                    ->where('u.id','=',$userID)
                    ->where('c.id','=',$companyID)
                    ->delete();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully remove from favourite'
        ]);
    }
}
