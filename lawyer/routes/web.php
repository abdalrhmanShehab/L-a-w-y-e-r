<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
   'namespace'=>'',
   'prefix'=>'admin',
   'middleware'=>'is_admin'
],function($router){
    Route::get('/dashboard',[\App\Http\Controllers\AdminController::class,'index'])->name('admin.home');
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/appointments', AppointmentController::class);
    Route::get('/createEvent',[AppointmentController::class,'createEvent'])->name('event.create');
});


Route::group([
    'namespace'=>'App\Http\Controllers',
    'prefix'=>'',
    'middleware'=>'auth'
],function($router){


});
