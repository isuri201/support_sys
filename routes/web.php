<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/search',[TicketController::class,'search'])->name('search');

 Route::resource('/tickets', 'App\Http\Controllers\TicketController');
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::resource('/comments', 'App\Http\Controllers\CommentController');

Route::get('/customerhome', [CustomerController::class, 'index'])->name('customer.home');
Route::post('/statusUpdate',[TicketController::class,'statusUpdate'])->name('status.update');
