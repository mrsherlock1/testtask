<?php

use App\Http\Controllers\RewardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->group(function (){
//
//});

Route::prefix('rewards')->group(function (){
    Route::get('/',[RewardController::class,'index']);
    Route::delete('/{reward}/delete', [RewardController::class,'delete']);
    Route::post('/', [RewardController::class,'create']);
    Route::put('/{reward}/update', [RewardController::class,'update']);
    Route::post('/{reward}/{user_id}/attach', [RewardController::class,'attachToUser']);
    Route::get('/user/{user_id}', [RewardController::class,'getByUserId']);
});
