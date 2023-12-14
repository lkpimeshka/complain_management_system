<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('article/list', [ArticleController::class, 'index'])->middleware('auth');
Route::get('article/create', [ArticleController::class, 'createArticle'])->middleware('auth');
Route::post('article/save', [ArticleController::class, 'saveArticle'])->name('store-article')->middleware('auth');
Route::get('article/edit/{id}', [ArticleController::class, 'editArticle'])->middleware('auth');
Route::post('article/update', [ArticleController::class, 'updateArticle'])->name('update-article')->middleware('auth');
Route::get('article/view/{id}', [ArticleController::class, 'viewArticle'])->middleware('auth');
Route::get('article/delete/{id}', [ArticleController::class, 'deleteArticle'])->middleware('auth');




































Route::get('/data-table', function () {
    return view('package.indexTable');
});

Route::get('/send-mail', [App\Http\Controllers\HomeController::class, 'sendMail']);

// Resource Route for User Details.
Route::resource('users', UserDetailController::class)->middleware('auth');
// Route for get users for yajra post request.
Route::get('get-users', [UserDetailController::class, 'getUsers'])->name('get-users')->middleware('auth');
Route::get('view-user/{id}', [UserDetailController::class, 'viewUser'])->name('userView')->middleware('auth');
Route::get('user/changeAccountStatus/{id}', [UserDetailController::class, 'changeAccountStatus'])->middleware('auth');
Route::post('updateUser', [UserDetailController::class, 'updateUser'])->name('update-user')->middleware('auth');
Route::get('upload',[UserDetailController::class, 'index'])->middleware('auth');
Route::post('crop',[UserDetailController::class, 'cropProfile'])->name('crop')->middleware('auth');
Route::get('my-account', [UserDetailController::class, 'myAccount'])->name('my-account')->middleware('auth');
Route::post('updateAccount', [UserDetailController::class, 'updateAccount'])->name('update-account')->middleware('auth');




