<?php

use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/*

*/
Route::post('/login',[UserController::class,'createUser']);
Route::group(['namespace'=>'Api'],function(){
    // Route::post('/login','UserController@createUser');

    Route::group(['middleware'=>['auth:sanctum']],function(){
        Route::any('/courseList',[CourseController::class,'courseList']);
    });

});

