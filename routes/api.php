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
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('forget/password', 'AuthController@forgetPassword');
    //end auth

    // ----------------- Home -----------------//
    Route::get('header', 'HomeController@header');
    Route::get('categories', 'HomeController@categories');
    Route::get('about_us', 'HomeController@aboutUs');
    Route::get('review', 'HomeController@reviews');
    Route::get('instructors', 'HomeController@instructors');
    Route::get('instructors/show/{id}', 'HomeController@instructorsShow');
    Route::get('blogs', 'HomeController@blogs');
    Route::post('subscribe', 'HomeController@subscribe');
    // ----------------- End Home -----------------//

    // ----------------- about-us-02.html -----------------//

    Route::get('aboutUs', 'AboutUsController@about');
    Route::get('feature', 'AboutUsController@feature');
    Route::get('instructor', 'AboutUsController@instructors');
    Route::get('partners', 'AboutUsController@partners');

    // ----------------- End about-us-02.html -----------------//

    //------------------ faqs -----------------//
    Route::get('faqs/question', 'FaqController@index');
    Route::post('faqs/contact_us', 'FaqController@contact');
    //------------------ End faqs -----------------//

    //------------------ Courses -----------------//
    Route::get('courses', 'CourseController@index');
    Route::get('courses/{id}', 'CourseController@show');
    Route::get('courses/instructor/{id}', 'CourseController@instructorCourses');
    Route::get('courses/related/{id}', 'CourseController@related');
    Route::get('courses/{id}', 'CourseController@show');
    Route::get('courses/filter/list', 'CourseController@filterList');
    Route::get('filter', 'CourseController@filter');

    Route::get('courses/related/{id}', 'CourseController@related');
    //------------------ End Courses -----------------//


    Route::middleware('auth:sanctum')->group(function () {
        //-----------------Profile-----------------//
        Route::get('logout', 'AuthController@logout');
        Route::get('profile', 'ProfileController@index');
        Route::post('profile/update', 'ProfileController@update');
        Route::post('profile/update/password', 'ProfileController@updatePasword');
        Route::post('profile/update/social', 'ProfileController@updateSocial');

        //-----------------Dashboard-----------------//
        Route::get('dashboard', 'ProfileController@dashboard');
        //-----------------End Dashboard-----------------//
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

        //----------------- orders -----------------//
        Route::get('orders', 'ProfileController@orders');
        Route::get('orders/{id}', 'ProfileController@orderDetails');
        //-----------------End orders -----------------//

        // ----------------- Courses Instructor -----------------//
        Route::post('courses/store', 'CourseController@store');
        Route::get('courses/edit/{id}', 'CourseController@edit');
        Route::post('courses/update/{id}', 'CourseController@update');
        Route::post('courses/delete/{id}', 'CourseController@destroy');
        Route::post('courses/price/update/{id}', 'CourseController@updatePrice');
        Route::get('courses/status/update/{id}/{status}', 'CourseController@statusUpdate');
        //-----------------End Courses Instructor -----------------//

        //----------------- Topices Courses -----------------//
        //Route::get('courses/topics', 'TopicesController@inedx');
        Route::post('courses/topics/store', 'TopicesController@store');
        Route::get('courses/topics/edit/{id}', 'TopicesController@edit');
        Route::post('courses/topics/update/{id}', 'TopicesController@update');

        //----------------- lessons -----------------//
       // Route::get('lessons/{id}', 'LessonController@index');
        Route::get('lessons/show/{id}', 'LessonController@show');
        Route::post('lessons/store', 'LessonController@store');
        Route::put('lessons/update/{id}', 'LessonController@update');
        Route::post('lessons/delete/{id}', 'LessonController@destroy');
        //-----------------End lessons -----------------//

        //----------------- Quiz -----------------//
       // Route::get('quiz/{id}', 'QuizController@index');
        Route::get('quiz/show/{id}', 'QuizController@show');
        Route::post('quiz/store', 'QuizController@store');
        Route::put('quiz/update/{id}', 'QuizController@update');
        Route::post('quiz/delete/{id}', 'QuizController@destroy');
        //-----------------End Quiz -----------------//


        //-----------------End Profile-----------------//


        //----------------- Cart -----------------//
        Route::get('cart', 'CartController@index');
        Route::get('cart/add/{id}', 'CartController@add');
        Route::get('cart/remove/{id}', 'CartController@remove');
        Route::get('cart/clear', 'CartController@clear');
        //coupon
        Route::post('cart/coupon', 'CartController@coupon');
        Route::post('cart/checkout', 'CartController@checkout');
        //-----------------End Cart -----------------//
    });
});
