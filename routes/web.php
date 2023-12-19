<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ComplainController;
use App\Http\Controllers\AssignController;

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

Route::get('complain/list', [ComplainController::class, 'index'])->middleware('auth');
Route::get('complain/create', [ComplainController::class, 'createComplain'])->middleware('auth');
Route::post('complain/save', [ComplainController::class, 'saveComplain'])->name('store-complain')->middleware('auth');
Route::get('complain/edit/{id}', [ComplainController::class, 'editComplain'])->middleware('auth');
Route::post('complain/update', [ComplainController::class, 'updateComplain'])->name('update-complain')->middleware('auth');
Route::get('complain/view/{id}', [ComplainController::class, 'viewComplain'])->middleware('auth');
Route::get('complain/delete/{id}', [ComplainController::class, 'deleteComplain'])->middleware('auth');


Route::get('assigns/assignUser/{id}', [AssignController::class, 'assignUser'])->middleware('auth');
Route::post('assign/save', [AssignController::class, 'saveAssign'])->name('store-assign')->middleware('auth');
Route::get('assigns/index', [AssignController::class, 'index'])->middleware('auth');

Route::get('complain/list', [ComplainController::class, 'index'])->middleware('auth');
Route::get('complain/create', [ComplainController::class, 'createAssign'])->middleware('auth');
Route::post('complain/save', [ComplainController::class, 'saveAssign'])->name('store-complain')->middleware('auth');
Route::get('complain/edit/{id}', [ComplainController::class, 'editAssign'])->middleware('auth');
Route::post('complain/update', [ComplainController::class, 'updateAssign'])->name('update-complain')->middleware('auth');
Route::get('complain/view/{id}', [ComplainController::class, 'viewComplain'])->middleware('auth');
Route::get('complain/delete/{id}', [ComplainController::class, 'deleteComplain'])->middleware('auth');



Route::get('role/list', [RoleController::class, 'index'])->middleware('auth');
Route::get('role/create', [RoleController::class, 'createRole'])->middleware('auth');
Route::post('role/save', [RoleController::class, 'saveRole'])->name('store-role')->middleware('auth');
Route::get('role/edit/{id}', [RoleController::class, 'editRole'])->middleware('auth');
Route::post('role/update', [RoleController::class, 'updateRole'])->name('update-role')->middleware('auth');
Route::get('role/view/{id}', [RoleController::class, 'viewRole'])->middleware('auth');
Route::get('role/delete/{id}', [RoleController::class, 'deleteRole'])->middleware('auth');

Route::get('user/list', [UserController::class, 'index'])->middleware('auth');
Route::get('user/create', [UserController::class, 'createUser'])->middleware('auth');
Route::post('user/save', [UserController::class, 'saveUser'])->name('add-user')->middleware('auth');
Route::get('user/edit/{id}', [UserController::class, 'editUser'])->middleware('auth');
Route::post('user/update', [UserController::class, 'updateUser'])->name('update-user')->middleware('auth');
Route::get('user/view/{id}', [UserController::class, 'viewUser'])->middleware('auth');
Route::get('user/delete/{id}', [UserController::class, 'deleteUser'])->middleware('auth');





































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
// Route::post('updateUser', [UserDetailController::class, 'updateUser'])->name('update-user')->middleware('auth');
Route::get('upload',[UserDetailController::class, 'index'])->middleware('auth');
Route::post('crop',[UserDetailController::class, 'cropProfile'])->name('crop')->middleware('auth');
Route::get('my-account', [UserDetailController::class, 'myAccount'])->name('my-account')->middleware('auth');
Route::post('updateAccount', [UserDetailController::class, 'updateAccount'])->name('update-account')->middleware('auth');





