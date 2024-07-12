<?php

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

Route::get('/lists',[RecordListController::class,'index']);
Route::post('/lists',[RecordListController::class,'store']);
Route::get('/lists/{recordList}',[RecordListController::class,'show']);
Route::put('/lists/{recordList}',[RecordListController::class,'update']);
Route::delete('/lists/{recordList}',[RecordListController::class,'destroy']);


Route::get('/notes',[NoteController::class,'index']);
Route::get('/notes/{note}',[NoteController::class,'show']);
Route::post('/notes/{recordList}',[NoteController::class,'store']);
Route::put('/notes/{note}',[NoteController::class,'update']);
Route::delete('/notes/{note}',[NoteController::class,'destroy']);

