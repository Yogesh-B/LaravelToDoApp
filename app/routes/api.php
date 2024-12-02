<?php

use App\Http\Controllers\AclController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RecordListController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


#TODO: add authenticaation
#TODO: separate api directory for api controllers





// Route::group(['middleware'=>['auth']],function($router){
Route::group(['middleware'=>['auth.jwt']],function($router){

    //authentication routes
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login','login')->withoutMiddleware(['auth.jwt']);
        Route::post('/register','register')->withoutMiddleware(['auth.jwt']);
        Route::post('/logout','logout');
        Route::post('/refresh_token','refresh')->withoutMiddleware(['auth.jwt']);
        Route::get('/profile','profile');
    });


    
    
    //feature routes
    Route::controller(RecordListController::class)->group(function () {
        Route::get('/record_lists','index');
        Route::post('/record_lists','store');
        Route::get('/record_lists/{recordList}','show');
        Route::put('/record_lists/{recordList}','update');
        Route::delete('/record_lists/{recordList}','destroy');
    });
    
    Route::controller(NoteController::class)->group(function () {
        Route::get('/notes','index');
        Route::get('/notes/{note}','show');
        Route::post('/notes/{recordList}','store');
        Route::put('/notes/{note}','update');
        Route::delete('/notes/{note}','destroy');
    });

    //entity_type and entity_id will be passed in payload
    Route::controller(AclController::class)->group(function () {
       Route::post('/permissions/show','show'); 
       Route::post('/permissions/grant','create'); 
       Route::post('/permissions/update/{acl}','update'); 
       Route::delete('/permissions/delete/{acl}','destroy'); 
    });


});

