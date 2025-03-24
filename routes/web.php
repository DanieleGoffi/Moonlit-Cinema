<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MovieController;

#Route::get('/', function () {
 #   return view('welcome');
#});

Route::get('/', [FrontController::class, 'getHome'])->name('home');

Route::resource('movie', MovieController::class);