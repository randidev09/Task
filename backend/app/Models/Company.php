<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    public $timestamps = false;
    protected $fillable = [
        'comp_name',
        'address',
        'phone',
    ];

    public static function getFavouriteCompany($id){
        $companies = DB::table('company as c')
                    ->join('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                    ->join('user as u', 'u.id', '=', 'f.userID')
                    ->select('c.*')
                    ->where('u.id','=',$id)
                    ->get();

        return $companies;
    }

    public static function deleteFavourite($userID,$companyID){
        $companies = DB::table('favouriteCompany')
                    ->where('userID',$userID)
                    ->where('companyID',$companyID)
                    ->delete();
        
        return $companies;
    }

    public static function selectCompany($request){
        $userID = $request->user_id;
        $keyword = $request->keyword;

        if(empty($keyword)){
            $companies = DB::table('company as c')
                        ->leftJoin('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                        ->leftJoin('user as u', 'u.id', '=', 'f.userID')
                        ->select('c.*', DB::raw('count(f.companyID) as isFavourite'), DB::raw('max(u.id) as user_id'))
                        ->groupBy('c.id')
                        ->get();
        }else{
            $companies = DB::table('company as c')
                        ->leftJoin('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                        ->leftJoin('user as u', 'u.id', '=', 'f.userID')
                        ->select('c.*', DB::raw('count(f.companyID) as isFavourite'), DB::raw('max(u.id) as user_id'))
                        ->where('c.comp_name', 'LIKE', "%{$keyword}%") 
                        ->groupBy('c.id')
                        ->get();
        }
        
        return $companies;
    }
}
