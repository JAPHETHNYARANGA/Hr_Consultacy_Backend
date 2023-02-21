<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\listingController;
use App\Models\listings;
use Illuminate\Auth\AuthenticationException;
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



//authentication 

Route::post('login', [AuthenticationController::class, 'login']);

Route::post('register',[AuthenticationController::class, 'register']);

Route::post('activate',[AuthenticationController::class, 'activate']);

Route::get('logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');

//Get All Users

Route::get('users',[AuthenticationController::class, 'users'])->middleware('auth:api');

Route::get('deleteUser/{id}', [AuthenticationController::class, 'delete']);


//listing

Route::post('addJob',[listingController::class, 'addListing'])->middleware('auth:api');

Route::get('allJobs',[listingController::class,'getListing']);

Route::get('deleteJob/{id}', [listingController::class, 'deleteListing'])->middleware('auth:api');