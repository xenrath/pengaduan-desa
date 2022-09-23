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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
Route::post('/login', 'Restful\UserController@loginMobile');
Route::post('/register', 'Restful\UserController@registerMobile');

Route::get('/complaint', 'Restful\ComplaintController@index');
Route::group(['middleware' => 'auth:api'], function(){
    // Complaints
    Route::get('/complaint/approved', 'Restful\ComplaintController@indexApproved');
    Route::get('/complaint/decline', 'Restful\ComplaintController@indexDecline');
    Route::get('/complaint/waiting', 'Restful\ComplaintController@indexWaiting');
    Route::get('/complaint/finished', 'Restful\ComplaintController@indexFinished');
    Route::get('/complaint/by-user', 'Restful\ComplaintController@complaintByUser');

    Route::get('/complaint/{id}', 'Restful\ComplaintController@show');

    Route::post('/complaint', 'Restful\ComplaintController@store');
    Route::put('/complaint/{id}', 'Restful\ComplaintController@update');
    Route::delete('/complaint/{id}', 'Restful\ComplaintController@destroy');

    Route::post('/details', 'Restful\UserController@details');
    Route::post('/save-token', 'Restful\UserController@saveDeviceToken');
});

// Complaint Categories
Route::get('/complaint-category', 'Restful\ComplaintCategoryController@index');
Route::post('/complaint-category', 'Restful\ComplaintCategoryController@store');
Route::put('/complaint-category/{id}','Restful\ComplaintCategoryController@update');
Route::delete('/complaint-category/{id}', 'Restful\ComplaintCategoryController@destroy');