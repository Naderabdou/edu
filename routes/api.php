<?php

use App\Http\Controllers\Api\counterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api_localization')->namespace('Api')->group(function () {

    //auth
    Route::post('login' , 'AuthController@login');
    //end auth


});


