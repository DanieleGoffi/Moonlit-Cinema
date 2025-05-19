<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScreenController;

#Route::get('/', function () {
 #   return view('welcome');
#});

Route::get('/', [FrontController::class, 'getHome'])->name('home');

Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
Route::get('/ajaxUser', [AuthController::class, 'ajaxCheckForEmail']);



Route::get('client/movie', [MovieController::class, 'indexClient'])->name('movie.client.index');
Route::get('client/movie/{movie}', [MovieController::class, 'showClient'])->name('movie.client.show');


Route::group(['middleware' => ['authCustom', 'isAdmin']], function () {
    Route::resource('movie', MovieController::class);
    Route::get('/ajaxMovie', [MovieController::class, 'ajaxCheckMovie']);
    Route::resource('screen', ScreenController::class);
});




Route::fallback(function () {
    return view('errors.404', ['message' => 'Error 404 - Page not found!']);
});