<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\Auth\AuthController;

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

// // Redirect '/' to the medicines index page
// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });

use App\Http\Controllers\ButtonController;

Route::get('/', [ButtonController::class, 'index'])->name('home');

Route::get('/route1', [ButtonController::class, 'route1'])->name('route1');
Route::get('/route2', [ButtonController::class, 'route2'])->name('route2');
Route::get('/route3', [ButtonController::class, 'route3'])->name('route3');


// Medicine resource routes (CRUD)
Route::resource('medicines', MedicineController::class);

// Custom route for selling medicine
Route::post('medicines/{medicine}/sell', [MedicineController::class, 'sell'])->name('medicines.sell');


Route::resource('medicines', MedicineController::class);



Route::resource('medicines', MedicineController::class);
Route::post('medicines/{id}/sell', [MedicineController::class, 'sell'])->name('medicines.sell');



Route::get('login', [AuthController::class, 'index'])->name('login');

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::get('dashboard', [AuthController::class, 'dashboard']); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/', function () {
//     return view('dashboard'); // This will load dashboard.blade.php
// })->name('home');




Route::resource('pharmacies', PharmacyController::class);

