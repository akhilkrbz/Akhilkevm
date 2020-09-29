<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Categories... 
Route::post('vendor/categories',[CategoryController::class,'create']);
Route::put('vendor/categories/{id}',[CategoryController::class,'update']);
Route::get('vendor/categories',[CategoryController::class,'index']);
Route::delete('vendor/categories/{id}',[CategoryController::class,'destroy']);
