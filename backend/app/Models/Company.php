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
        $companies = DB::table('company as c')
                    ->join('favouriteCompany as f', 'f.companyID', '=', 'c.id')
                    ->join('user as u', 'u.id', '=', 'f.userID')
                    ->select('c.*')
                    ->where('u.id','=',$userID)
                    ->where('c.id','=',$companyID)
                    ->delete();
        
        return $companies;
    }
}
