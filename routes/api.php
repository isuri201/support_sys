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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => 'App\Http\Controllers\API\V1',
    'prefix' => 'v1',
], function() {
    Route::post('/apiticketstore', 'TicketsController@store')->name('api.store');
    Route::get('/apitickets', 'TicketsController@index')->name('api.index');
    Route::post('/apiticket/update/{id}' , 'TicketsController@update')->name('api.update');
    Route::get('/apiticket/destroy/{id}', 'TicketsController@destroy')->name('api.delete');
});
