<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/register', [AuthController::class , 'loadRegister']);
Route::post('/register', [AuthController::class , 'studentRegister'])->name('studentRegister');

Route::get('/login', function () {
    return redirect('/');
});

Route::get('/', [AuthController::class , 'loadLogin']);
Route::post('/login', [AuthController::class , 'userLogin'])->name('userLogin');

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget-password', [AuthController::class , 'forgetPasswordLoad']);
Route::post('/forget-password', [AuthController::class , 'forgetPassword'])->name('forgetPassword');

Route::get('/reset-password', [AuthController::class , 'resetPasswordLoad']);
Route::post('/reset-password', [AuthController::class , 'resetPassword'])->name('resetPassword');

Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::get('/admin/dashboard',[AuthController::class, 'adminDashboard']);
});

Route::group(['middleware'=>['web','checkStudent']],function(){
    Route::get('/dashboard',[AuthController::class, 'studentDashboard']);
    
});