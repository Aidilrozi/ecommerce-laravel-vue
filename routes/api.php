<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('tokens/create',function(Request $request){
    
     $token = $request->user()->createToken($request->token_name);
     return ['token' =>$token->plainTextToken];

});
Route::post('order/create','App\Http\Controllers\OrderApiController@AddNewOrder')->middleware('auth:sanctum');
Route::get('order/list','App\Http\Controllers\OrderApiController@index')->middleware('auth:sanctum');

// Route::resource('order','App\Http\Controllers\OrderApiController')->middleware('auth:sanctum');

