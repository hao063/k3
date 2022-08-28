<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthController;



// Route::group(['middleware' => 'check.auth.admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/post-login', [AuthController::class, 'postLogin'])->name('post.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/user' , UserController::class);
    Route::resource('/role' , RoleController::class);
    Route::resource('/permission' , PermissionController::class);
    Route::resource('/post' , PostController::class);
});

