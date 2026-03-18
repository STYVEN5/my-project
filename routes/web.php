<?php

use App\Http\Controllers\ServerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteTypeController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('users',        UserController::class);
    Route::resource('units',        UnitController::class);
    Route::resource('site-types',   SiteTypeController::class);
    Route::resource('technologies', TechnologyController::class);
    Route::resource('servers',      ServerController::class);
    Route::resource('sites',        SiteController::class);
});
