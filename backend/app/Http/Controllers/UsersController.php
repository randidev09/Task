<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\FavouriteCompany;
use App\Http\Controllers\MailController;

class UsersController extends Controller
{
    public function index(){
        return User::all();
    }

    public function create(request $request){
        $rules = [
            'username'              => 'required',
            'email'                 => 'required|email|unique:user,email',
            'phone'                 => 'required',
            'password'              => 'required'
        ];
  
        $messages = [
            'username.required'     => 'Username cant be blank',
            'email.required'        => 'Email cant be blank',
            'email.email'           => 'Email does not valid',
            'email.unique'          => 'Email already registered',
            'password.required'     => 'Password cant be blank'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'code' => '300',
                'message' => 'Failed to create user'
            ]);
        }

        $verif_code                 = Str::random(12);
        $user                       = new User;
        $user->username             = $request->username;
        $user->email                = $request->email;
        $user->phone                = $request->phone;
        $user->password             = Hash::make($request->password);
        $user->token_auth           = Str::random(64);
        $user->verification_code    = $verif_code;
        $user->email_status         = 0;
        $user->save();

        MailController::sendRegisterEmail($request->username, $request->email, $verif_code, $user->id);

        return response()->json([
            'code' => '200',
            'message' => 'Successfully create user'
        ]);
    }

    public function verifyEmail($id,$code){
        $user   = User::find($id);

        if($user->verification_code == $code){
            $user->email_status = 1;
            $user->save();
            return redirect('http://localhost:8080/success_verify');
        }else{
            return abort(404);
        }
    }

    public function updatePassword(request $request){
        $rules = [
            'curpassword'                 => 'required',
            'newpassword'                 => 'required',
            'conpassword'                 => 'required',
        ];
  
        $messages = [ ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'code' => '300',
                'message' => 'Failed to reset password user'
            ]);
        }
        $user_id        = $request->user_id;
        $curpassword    = $request->curpassword;
        $newpassword    = $request->newpassword;
        $conpassword    = $request->conpassword;

        $user           = User::find($user_id);
        if(!empty($user) && ! Hash::check( $curpassword, $user->password)){
            return response()->json([
                'code' => '401',
                'message' => 'Current password doesnt match'
            ]);
        }else{
            $user->password = Hash::make($newpassword);
            $user->save();

            return response()->json([
                'code' => '200',
                'message' => 'Successfully reset password',
                'user' => $user
            ]);
        }
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
        $companies = Company::getFavouriteCompany($id);

        return response()->json([
            'code' => '200',
            'companies' => $companies
        ]);
    }

    public function addFavourite(request $request){
        $userID     = $request->userid;
        $companyID  = $request->companyid;

        if(FavouriteCompany::where('userId',$userID)->where('companyID',$companyID)->exists()){
            return response()->json([
                'code' => '200',
                'message' => 'Already added to favourite'
            ]);
        }else{
            $favourite              = new FavouriteCompany();
            $favourite->userID      = $userID;
            $favourite->companyID   = $companyID;
            $favourite->save();

            return response()->json([
                'code' => '200',
                'message' => 'Successfully added to favourite'
            ]);
        }
    }

    public function deleteFavourite(request $request){
        $userID     = $request->userid;
        $companyID  = $request->companyid;
        $companies  = Company::deleteFavourite($userID,$companyID);

        return response()->json([
            'code' => '200',
            'message' => 'Successfully remove from favourite'
        ]);
    }
}
