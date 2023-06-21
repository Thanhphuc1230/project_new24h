<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProfileController as PController;
use App\Http\Controllers\Admin\CrawlerController;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\PositionStaffController;


use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\NewsController as NController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\SearchController;

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\SocialController;


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
Route::get('/clear/data/123', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::fallback(function () {
    return response()->view('website.modules.error.index', [], 404);
});


Route::get('verify/{uuid}', [LoginController::class, 'verify'])->name('verify');
Route::get('/verify_email/{token}', [ProfileController::class, 'verifyEmail'])->name('verifyEmail');

//Login
Route::get('/get_login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/post_login', [LoginController::class, 'postLogin'])->name('postLogin');

//Login with Social
route::get('/auth/{provider}',[SocialController::class,'redirect'])->name('provider-auth');
Route::get('auth/{provider}/call-back',[SocialController::class,'callbackSocial']);

//register
Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/post_register', [LoginController::class, 'postRegister'])->name('postRegister');
Route::get('/register/sendMail', [LoginController::class, 'sendMail'])->name('sendMail');
//forgot password
Route::get('password/forgot', [LoginController::class, 'getForgot'])->name('getForgot');
Route::post('password/forgot', [LoginController::class, 'sendResetLink'])->name('sendResetLink');
Route::get('password/reset/{token}', [LoginController::class, 'showResetFrom'])->name('showResetFrom');
Route::post('password/reset', [LoginController::class, 'resetPassword'])->name('resetPassword');
//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('check_login')->group(function () {
    
    Route::post('/check-session-and-logout',[AdminBaseController::class, 'checkSessionAndLogout'])->name('checkSessionAndLogout');
    
    //check level admin
    Route::middleware('admin.authorization')->group(function () {
    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(
        function () {
            Route::get('/', 'index')->name('index');
            Route::get('/status_categories/{uuid}/{status}', 'status_categories')->name('status_categories');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::post('/update/{uuid}', 'update')->name('update');
            Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
        }
    );
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/','index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/status_user/{uuid}/{status}', 'status_user')->name('status_user');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::post('/update/{uuid}', 'update')->name('update');
        Route::get('/destroy/{uuid}', 'destroy')->name('destroy');

    });
    Route::controller(PositionStaffController::class)->prefix('position')->name('position.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/status_position/{uuid}/{status}', 'status_position')->name('status_position');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::post('/update/{uuid}', 'update')->name('update');
        Route::get('/destroy/{uuid}', 'destroy')->name('destroy');

    });
    Route::controller(CommentController::class)->prefix('comment')->name('comment.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/status_comment/{uuid}/{status}', 'status_comment')->name('status_comment');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::post('/update/{uuid}', 'update')->name('update');
        Route::get('/destroy/{uuid}', 'destroy')->name('destroy');

    });

    Route::get('/get-data', [CrawlerController::class, 'featchAllTuoiTre'])->name('getData');
    });


    Route::controller(PController::class)->prefix('profile_admin')->name('profile_admin.')->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/updated_profile', 'updatedProfile')->name('updatedProfile');
        Route::post('/updated_password', 'updatedPassword')->name('updatedPassword');
        Route::post('/updated_email','updatedEmail')->name('updatedEmail');

    });
    Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');

    Route::controller(NewsController::class)->prefix('news')->name('news.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/status_news/{uuid}/{status}', 'status_news')->name('status_news');
        Route::get('/hotNew/{uuid}/{hotNew}', 'hotNew')->name('hotNew');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::post('/update/{uuid}', 'update')->name('update');
        Route::get('/destroy/{uuid}', 'destroy')->name('destroy');

    });
 
});
Route::name('website.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/checkUser', [HomeController::class, 'checkUser'])->name('checkUser');
    //search 
    Route::post('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/searchNow', [SearchController::class, 'searchNow'])->name('searchNow');
    Route::get('/live_search', [SearchController::class, 'liveSearch'])->name('liveSearch');
    //Category news
    Route::get('/the-loai/{name_cate}/{uuid}', [HomeController::class, 'category_news'])->name('category_news');
    Route::post('/the-loai/{name_cate}/{uuid}/load-data', [HomeController::class,'loadMoreCategory'])->name('load-data-category');
    Route::get('/hot-news', [HomeController::class, 'hotNews'])->name('hotNews');
    Route::post('/hot-news/load-data', [HomeController::class,'loadMoreData'])->name('load-data');
    //News
    Route::get('/{name_post}/{uuid}', [NController::class, 'detailNew'])->name('detailNew');
    Route::post('/postComment/{uuidOfNew}', [NController::class, 'postComment'])->name('postComment');


    //account_user
    // Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
        Route::get('/test', [ProfileController::class, 'test'])->name('test');


        Route::delete('/delete/{uuid_history}',[ProfileController::class, 'deleteHistory'])->name('deleteHistory');


        Route::get('/edit_comment/{uuid}/edit', [ProfileController::class, 'editComment'])->name('editComment');
        Route::delete('/delete_comment/{uuid_comment}', [ProfileController::class, 'deleteComment'])->name('deleteComment');

        Route::post('/updated_comment/{uuid}', [ProfileController::class, 'updatedComment'])->name('updatedComment');

        Route::post('/updated_profile/{uuid}', [ProfileController::class, 'updatedProfile'])->name('updatedProfile');
        Route::post('/updated_password/{uuid}', [ProfileController::class, 'updatedPassword'])->name('updatedPassword');
        Route::post('/updated_email/{uuid}', [ProfileController::class, 'updatedEmail'])->name('updatedEmail');
        Route::post('/save_post/{uuid}', [NController::class, 'savePost'])->name('savePost');


        Route::delete('/delete_save_post/{uuid_save_post}', [ProfileController::class, 'deleteSavePost'])->name('deleteSavePost');

    // });
   
});


