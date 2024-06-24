<?php

use App\Models\Rate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('checkout');
});

Route::post('/create-order', [PaymentController::class, 'createOrder'])->name('create-order');

// Localization Routes
Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');

Route::middleware('localization')->group(function () {


    // =========================== Routs Admins  =========================== //
    Route::prefix('admin')->namespace('Dashboard')->name('admin.')->group(function () {

        // =========================== Auth  =========================== //

        Route::get('login', 'AuthController@showLoginForm')->name('login');
        Route::post('login', 'AuthController@login')->name('login.post');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::get('reset-password', 'AuthController@reset')->name('reset');
        Route::post('send-link', 'AuthController@sendLink')->name('sendLink');
        Route::get('changePassword/{code}', 'AuthController@changePassword')->name('changePassword');
        Route::post('update-password', 'AuthController@updatePassword')->name('updatePassword');
        // =========================== End Auth  =========================== //

        Route::middleware('auth')->group(function () {

            // =========================== Dashboard  =========================== //
            Route::get('/', 'DashboardController@home')->name('home');
            // =========================== End Dashboard  =========================== //


            //  =========================== questionsRepate  =========================== //
            Route::resource('questionsRepate', 'QuestionRepateController');
            //  =========================== End questionsRepate  =========================== //


            //  =========================== Settings  =========================== //
            Route::resource('settings', 'SettingController')->only(['create', 'store']);
            //  =========================== End Settings  =========================== //

            //  =========================== reviews  =========================== //
            Route::resource('reviews', 'ReviewController');
            //  =========================== End reviews  =========================== //

            // ------------------- Features Routes -------------------//
            Route::resource('features', 'FeatureController');
            //------------------- End Features Routes -------------------//

            //-------------------- Partner  Routes -------------------//
            Route::resource('partners', 'PartnerController');
            //-------------------- Partner Routes -------------------//
            //  =========================== Contact Us  =========================== //
            Route::get('contacts', 'ContactController@index')->name('contacts.index');

            Route::get('contacts/{id}', 'ContactController@show')->name('contacts.show');

            Route::get('contacts/{id}/reply', 'ContactController@showReplyForm')->name('contacts.reply');

            Route::post('contacts/send-reply', 'ContactController@sendReply')->name('contacts.sendReply');

            Route::delete('contacts/{id}', 'ContactController@deleteMsg')->name('contacts.deleteMsg');

            //  =========================== End Contact Us  =========================== //

            Route::resource('subscribe', 'SubscribeController');

            //  =========================== Profile Admin  =========================== //
            Route::get('profile', 'ProfileController@getProfile')->name('profile');

            Route::post('update-profile', 'ProfileController@updateProfile')->name('update_profile');

            Route::post('update-password', 'ProfileController@updatePassword')->name('update_profile_password');

            //  =========================== End Profile Admin =========================== //



            //  =========================== Tools  =========================== //
            Route::resource('tools', 'ConnectivityToolController')->except(['create', 'store', 'destroy']);
            Route::get('tools/toggle/{id}', 'ConnectivityToolController@toggle')->name('tools.toggle');
            //  =========================== End Tools  =========================== //


            //  =========================== Students  =========================== //
            Route::resource('students', 'StudentController');
            //  =========================== End Students  =========================== //

            //  =========================== Instructors  =========================== //
            Route::resource('instructors', 'InstructorController');
            //  =========================== End Instructors  =========================== //

            //  =========================== Categories  =========================== //
            Route::resource('categories', 'CategoryController');
            //  =========================== End Categories  =========================== //

            //  =========================== Courses  =========================== //
            Route::resource('courses', 'CourseController');
            //  =========================== End Courses  =========================== //

            //  =========================== Topics  =========================== //
            Route::resource('topics', 'TopicController');
            //  =========================== End Topics  =========================== //

            //  =========================== Lessons  =========================== //
            Route::resource('lessons', 'LessonController');
            Route::post('lessons/courses/tpices', 'LessonController@topices')->name('lesson.topices');
            //  =========================== End Lessons  =========================== //

            //  =========================== Certificates  =========================== //
            Route::resource('certificates', 'CertificateController')->only('index');
            //  =========================== End Certificates  =========================== //

            //  =========================== blogs =========================== //
            Route::resource('blogs', 'BlogController');
            //  =========================== End blogs  =========================== //


            //------------------- coupons Routes -------------------//
            Route::resource('coupons', 'CouponController');
            Route::get('coupon/change/status', 'CouponController@changeStatus')->name('coupon.status');
            //------------------- End  coupons Routes -------------------//


            //------------------- payments Routes -------------------//
            Route::resource('payments', 'PaymentController');
            Route::get('payment/change/status', 'PaymentController@changeStatus')->name('payment.status');

            //------------------- End  payments Routes -------------------//

            //-------------------  packages route -------------------//
            Route::resource('packages', 'PackageController');
            Route::get('packages/change/status', 'PackageController@changeStatus')->name('packages.status');
            //------------------- End  packages route -------------------//

            //------------------- Orders Routes -------------------//
            Route::resource('orders', 'OrderController')->except(['create', 'store', 'edit', 'update']);
            Route::get('orders/change-status/{id}/{status}', 'OrderController@changeStatus')->name('orders.change-status');
            //------------------- End  Orders Routes -------------------//



            //  =========================== Quizzes and Questions =========================== //
            Route::resource('quizzes', 'QuizController');
            // Route::resource('questions', 'QuestionController');
            Route::get('questions/create/{id}', 'QuestionController@create')->name('questions.create');
            Route::post('questions/store', 'QuestionController@store')->name('questions.store');
            Route::get('questions/show/{id}', 'QuestionController@show')->name('questions.show');
            Route::get('questions/edit/{id}', 'QuestionController@edit')->name('questions.edit');
            Route::post('questions/update/{id}', 'QuestionController@update')->name('questions.update');
            Route::delete('questions/destroy/{id}', 'QuestionController@destroy')->name('questions.destroy');
            //  =========================== End Quizzes  =========================== //


            //  =========================== End Lessons  =========================== //

            //  =========================== Check  =========================== //
            Route::post('check-username', 'CeckController@checkUsername')->name('check.username');
            Route::post('check-email', 'CeckController@checkEmail')->name('check.email');
            Route::post('check-phone', 'CeckController@checkPhone')->name('check.phone');
            Route::post('check-name', 'CeckController@checkName')->name('check.name');
            Route::post('check-slug', 'CeckController@checkSlug')->name('check.slug');
            Route::post('check-codeCoupons', 'CeckController@CodeCoupons')->name('check.codeCoupons');
            Route::post('check-paymentName', 'CeckController@paymentName')->name('check.paymentName');
            Route::post('check-features-name', 'CeckController@checkFeaturesName')->name('check.features.name');


            //  =========================== End Check  =========================== //

            //Route::post('uploadVideo' ,'uploadController@uploadLargeFiles')->name('files.upload.large');
            // =========================== Uploads using FilePond  =========================== //
            Route::post('tmp-uploads/{folder?}', 'uploadController@tmpUploads')->name('tmp.uploads');
            Route::delete('tmp-delete/{folder?}', 'uploadController@tmpUploadsDelete')->name('tmp.delete');
            Route::delete('tmp-refrsh/refrsh', 'uploadController@tmpUploadsrefrsh')->name('tmp.refrsh');
            Route::post('tmp-restore/{folder?}', 'uploadController@tmpUploadsRestore')->name('tmp.restore');
            Route::post('tmp.load/{folder?}', 'uploadController@tmpUploadsload')->name('tmp.load');
            // =========================== End Uploads using FilePond  =========================== //
        });
    });
    // =========================== End Routs Admins  =========================== //
});

Route::fallback(function () {
    abort(404);
});
