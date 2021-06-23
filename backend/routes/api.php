<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login','App\Http\Controllers\AuthController@login');
Route::get('logout','App\Http\Controllers\AuthController@logout');
Route::post('user','App\Http\Controllers\UsersController@create');
Route::get('user','App\Http\Controllers\UsersController@index');

Route::middleware(['is_login'])->group(function () {
    Route::put('/user/{id}','App\Http\Controllers\UsersController@update');
    Route::delete('/user/{id}','App\Http\Controllers\UsersController@delete');

    Route::get('company','App\Http\Controllers\CompanyController@index');
    Route::post('company','App\Http\Controllers\CompanyController@create');
    Route::put('/company/{id}','App\Http\Controllers\CompanyController@update');
    Route::delete('/company/{id}','App\Http\Controllers\CompanyController@delete');

    Route::get('/favourite/{id}','App\Http\Controllers\UsersController@myFavouriteCompany');
    Route::post('favourite','App\Http\Controllers\UsersController@addFavourite');
    Route::delete('/favourite','App\Http\Controllers\UsersController@deleteFavourite');
});