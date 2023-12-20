<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\AssignController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::view('/test-progress', 'progress'); # test route
Route::get('/test-mail', [UserController::class, 'testMail']);

// Route::group(['middleware' => 'web', 'prefix' => 'password', 'as' => 'password.'], function () {
//     // Password reset routes
//     Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
//     Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
//     Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
//     Route::post('reset', 'Auth\ResetPasswordController@reset')->name('update');
// });

Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('complain/list', [ComplainController::class, 'index'])->middleware('auth');
Route::get('complain/create', [ComplainController::class, 'createComplain'])->middleware('auth');
Route::post('complain/save', [ComplainController::class, 'saveComplain'])->name('store-complain')->middleware('auth');
Route::get('complain/edit/{id}', [ComplainController::class, 'editComplain'])->middleware('auth');
Route::post('complain/update', [ComplainController::class, 'updateComplain'])->name('update-complain')->middleware('auth');
Route::get('complain/view/{id}', [ComplainController::class, 'viewComplain'])->middleware('auth');
Route::get('complain/delete/{id}', [ComplainController::class, 'deleteComplain'])->middleware('auth');


Route::get('assigns/assignUser/{id}', [AssignController::class, 'assignUser'])->middleware('auth');
Route::post('assigns/save', [AssignController::class, 'saveAssign'])->name('store-assign')->middleware('auth');
Route::get('assigns/index', [AssignController::class, 'index'])->middleware('auth');
Route::get('assigns/completeJob/{id}', [AssignController::class, 'completeJob'])->middleware('auth');
Route::post('assigns/save', [AssignController::class, 'saveComplete_Job'])->name('store-assign')->middleware('auth');
/*Route::get('complain/edit/{id}', [ComplainController::class, 'editAssign'])->middleware('auth');
Route::post('complain/update', [ComplainController::class, 'updateAssign'])->name('update-complain')->middleware('auth');
Route::get('complain/view/{id}', [ComplainController::class, 'viewComplain'])->middleware('auth');
Route::get('complain/delete/{id}', [ComplainController::class, 'deleteComplain'])->middleware('auth');*/



Route::get('role/list', [RoleController::class, 'index'])->middleware('auth');
Route::get('role/create', [RoleController::class, 'createRole'])->middleware('auth');
Route::post('role/save', [RoleController::class, 'saveRole'])->name('store-role')->middleware('auth');
Route::get('role/edit/{id}', [RoleController::class, 'editRole'])->middleware('auth');
Route::post('role/update', [RoleController::class, 'updateRole'])->name('update-role')->middleware('auth');
Route::get('role/view/{id}', [RoleController::class, 'viewRole'])->middleware('auth');
Route::get('role/delete/{id}', [RoleController::class, 'deleteRole'])->middleware('auth');

Route::get('my-account', [UserController::class, 'myAccount'])->middleware('auth');
Route::get('user/list', [UserController::class, 'index'])->middleware('auth');
Route::get('user/create', [UserController::class, 'createUser'])->middleware('auth');
Route::post('user/save', [UserController::class, 'saveUser'])->name('add-user')->middleware('auth');
Route::get('user/edit/{id}', [UserController::class, 'editUser'])->middleware('auth');
Route::post('user/update', [UserController::class, 'updateUser'])->name('update-user')->middleware('auth');
Route::get('user/view/{id}', [UserController::class, 'viewUser'])->middleware('auth');
Route::get('user/delete/{id}', [UserController::class, 'deleteUser'])->middleware('auth');










































