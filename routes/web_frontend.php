<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AuthController;


// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login.frontend');
Route::post('/login-post', [AuthController::class, 'loginPost'])->name('login.post.frontend');
Route::get('/forget-password/{email?}', [AuthController::class, 'forgetPassword'])->name('forget.password.frontend');
Route::post('/forget-password-post', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post.frontend');
Route::get('/confirm-token-forget/{email}/{hash}', [AuthController::class, 'confirmTokenForget'])->name('confirm.token.forget');
Route::post('/post-confirm-token-frontend', [AuthController::class, 'confirmTokenForgetPost'])->name('post.confirm.token.frontend');
Route::get('/password-form-new/{email}/{hash}', [AuthController::class, 'formPasswordNew'])->name('form.passwork.new.frontend');
Route::post('/post-password-new', [AuthController::class, 'postPasswordNew'])->name('post.password.new.frontend');

// Post
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post-detail/{id}', [PostController::class, 'detail'])->name('detail');
Route::group(['middleware' => 'auth.user'], function () {
    Route::post('/post-comment/{id}', [PostController::class, 'postComment'])->name('post.comment');
    Route::get('/delete-comment/{id}', [PostController::class, 'deteteComment'])->name('delete.comment');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.frontend');
});
