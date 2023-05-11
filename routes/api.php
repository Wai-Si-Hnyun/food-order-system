<?php

use App\Http\Controllers\LocationController;
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

// location
Route::get('/countries', [LocationController::class, 'countries']);
Route::get('/states/{country}', [LocationController::class, 'statesByCountry']);
Route::get('/cities/{state}', [LocationController::class, 'citiesByState']);
