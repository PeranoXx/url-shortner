<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\linkController;
use App\Http\Controllers\stateController;
use Illuminate\Support\Facades\Route;

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

//auth
Route::get('/login', [authController::class, 'index'])->name('auth.index');
Route::post('/login', [authController::class, 'customLogin'])->name('auth.customLogin');
Route::get('/register', [authController::class, 'register'])->name('auth.register');
Route::post('/register', [authController::class, 'customRegistration'])->name('auth.customRegistration');
Route::get('/signout', [authController::class, 'signOut'])->name('auth.signout');



//home 
Route::get('/home', [linkController::class, 'index'])->name('url.index');
Route::post('/home', [linkController::class, 'createShortUrl'])->name('url.createShortUrl');

// link visit
Route::get('/x/{shortURLKey}', [linkController::class, 'linkVisit'])->name('url.linkVisit');
// Route::get('/short/{shortURLKey}', '\AshAllenDesign\ShortURL\Controllers\ShortURLController');

//states
Route::get('/states', [stateController::class, 'index'])->name('states.index');

Route::get('/', function () {
    return redirect('home');
});
