<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
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

Route::group([
    'middleware' => 'api'
], function ($router) {

    Route::post('login', [UserApiController::class, 'login']);
    Route::put('update/{idkaryawan}',  [UserApiController::class, 'update']);
    Route::post('logout', [UserApiController::class, 'logout']);
    Route::post('me', [UserApiController::class, 'me']);
    Route::post('refresh', [UserApiController::class, 'refreshToken']);
});