<?php

use App\Http\Controllers\ServerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteTypeController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users',        UserController::class);
Route::resource('units',        UnitController::class);
Route::resource('site-types',   SiteTypeController::class);
Route::resource('technologies', TechnologyController::class);
Route::get('servers/pdf', [ServerController::class, 'pdf'])->name('servers.pdf');
Route::resource('servers',      ServerController::class);

Route::get('sites/pdf', [SiteController::class, 'pdf'])->name('sites.pdf');
Route::resource('sites',        SiteController::class);
