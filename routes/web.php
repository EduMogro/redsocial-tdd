<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusesController;

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
Route::post('statuses', [StatusesController::class,'store'])->name('statuses.store')->middleware('auth');

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return Redirect::back();
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
