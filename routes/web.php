<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FreelanceController;

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



Route::get('/signup', function () {
    return view('signup');
});


Route::get('/login', function () {
    return view('login');
});


Route::post('/user_registration', [WelcomeController::class, 'user_registration'])->name('user_registration');
Route::post('/user_login', [WelcomeController::class, 'user_login'])->name('user_login');
Route::get('/logout', [WelcomeController::class, 'logout'])->name('logout');
Route::get('/search_select', [WelcomeController::class, 'search_select'])->name('search_select');
//client

Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
Route::get('/client/manage_jobs', [ClientController::class, 'manage_jobs'])->name('manage_jobs');
Route::post('/client/ajax/{section}', [ClientController::class, 'ajax'])->name('ajax');

Route::get('/freelance/dashboard', [FreelanceController::class, 'dashboard'])->name('dashboard');
Route::get('/freelance/profile', [FreelanceController::class, 'profile'])->name('profile');
Route::post('/freelance/ajax/{section}', [FreelanceController::class, 'ajax'])->name('ajax');

//client