<?php

use Illuminate\Http\Request;

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


Route::get('/get_task','Api\TaskContoller@getTask');
Route::get('/get_detail_task/{id}','Api\TaskContoller@get_detailTask');
Route::post('/post_complete_task','Api\TaskContoller@post_completeTask');
Route::post('/post_new_task','Api\TaskContoller@post_newTask');
Route::post('/post_delete_task','Api\TaskContoller@post_deleteTask');
Route::post('/post_edit_task','Api\TaskContoller@post_editTask');