<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteCompany extends Model
{
    use HasFactory;
    protected $table = 'favouriteCompany';
    public $timestamps = false;
    protected $hidden = [
        'userID',
        'companyID',
    ];
}
