<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StatusLikesController;
use App\Http\Controllers\StatusCommentsController;

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
})->name('home');

Auth::routes();

// Statuses routes
Route::get('statuses',[StatusesController::class,'index'])->name('statuses.index');
Route::post('statuses', [StatusesController::class,'store'])->name('statuses.store')->middleware('auth');

// Statuses likes routes
Route::post('statuses/{status}/likes',[StatusLikesController::class, 'store'])->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes',[StatusLikesController::class, 'destroy'])->name('statuses.likes.destroy')->middleware('auth');

// Statuses comments routes
Route::post('statuses/{status}/comments',[StatusCommentsController::class, 'store'])->name('statuses.comments.store')->middleware('auth');

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return Redirect::back();
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
