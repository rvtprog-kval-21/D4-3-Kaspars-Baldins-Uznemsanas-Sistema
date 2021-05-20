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

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::resource('applications', ApplicationController::class)->only('store');
Route::resource('specialities', SpecialityController::class)->only('index');
Route::get('branches', [\App\Http\Controllers\API\BranchController::class, 'index']);

Route::get('statistics', [\App\Http\Controllers\API\ApplicationController::class, 'statistics']);

Route::get('print/{id}', [ApplicationController::class, 'print']);
Route::get('cert/{id}', [ApplicationController::class, 'printCertificate']);

Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('today', [ApplicationController::class, 'today'])->name('get application');

    Route::resource('applications', ApplicationController::class)->except('store');


    Route::resource('specialities', SpecialityController::class)->except('index');
    Route::resource('groups', GroupController::class);

});

