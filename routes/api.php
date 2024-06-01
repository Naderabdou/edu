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
    Route::post('register' , 'AuthController@register');
    Route::post('forget/password' , 'AuthController@forgetPassword');
    //end auth

    Route::middleware('auth:sanctum')->group(function () {
        //-----------------Profile-----------------//
        Route::get('logout' , 'AuthController@logout');
        Route::get('profile', 'ProfileController@index');
        Route::post('profile/update', 'ProfileController@update');
        Route::post('profile/update/password', 'ProfileController@updatePasword');
        Route::post('profile/update/social', 'ProfileController@updateSocial');


        //-----------------Courses Enrolled-----------------//
        Route::get('courses/enrolled/{type}', 'ProfileController@EnrolledCourses');
        //-----------------End Courses Enrolled-----------------//

        //----------------- Wishlist -----------------//
        Route::get('wishlist', 'ProfileController@wishlist');
        Route::post('wishlist/add/{id}', 'ProfileController@addWishlist');
        Route::post('wishlist/remove/{id}', 'ProfileController@removeWishlist');
        //-----------------End Wishlist -----------------//

        //----------------- Reviews -----------------//
        Route::get('reviews', 'ProfileController@reviews');
        Route::post('reviews/add', 'ProfileController@addReview');
        Route::post('reviews/update/{id}', 'ProfileController@updateReview');
        Route::post('reviews/remove/{id}', 'ProfileController@removeReview');
        //-----------------End Reviews -----------------//


       //-----------------End Profile-----------------//
    });



});


