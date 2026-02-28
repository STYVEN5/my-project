<?php

use App\Http\Controllers\ServerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteTypeController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$only = ['store', 'show', 'update', 'destroy'];

Route::apiResource('users',        UserController::class)->only($only);
Route::apiResource('units',        UnitController::class)->only($only);
Route::apiResource('site-types',   SiteTypeController::class)->only($only);
Route::apiResource('technologies', TechnologyController::class)->only($only);
Route::apiResource('servers',      ServerController::class)->only($only);
Route::apiResource('sites',        SiteController::class)->only($only);
