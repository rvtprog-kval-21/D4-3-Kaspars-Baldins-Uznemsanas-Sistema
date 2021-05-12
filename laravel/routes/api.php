<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\SpecialityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::resource('applications', ApplicationController::class);
Route::get('print/{id}', [ApplicationController::class, 'print']);

Route::get('today', [ApplicationController::class, 'today'])->name('get application');

Route::resource('specialities', SpecialityController::class);
Route::resource('groups', GroupController::class);

Route::middleware('auth:api')->group( function () {

});

