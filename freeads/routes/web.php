<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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

Route::get('/', function(){
    return view('welcome');
})->name('welcome');





Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ads routes
Route::get('/annonces', [App\Http\Controllers\AdController::class, 'index'])->name('ad.index');

Route::get('/annonce', [App\Http\Controllers\AdController::class, 'create'])->name('ad.create');

Route::post('/annonce/create', [App\Http\Controllers\AdController::class, 'store'])->name('ad.store');


Route::post('/search', [App\Http\Controllers\AdController::class, 'search'])->name('ad.search');

Route::get('/message/{seller_id}/{ad_id}', [App\Http\Controllers\MessageController::class, 'create'])->name('message.create');
Route::post('/message', [App\Http\Controllers\MessageController::class, 'store'])->name('message.store');


