<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ButtonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController; // Add this line

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

Route::get('/', [ButtonController::class, 'index'])->name('home');

Route::get('/route1', [ButtonController::class, 'route1'])->name('route1');
Route::get('/route2', [ButtonController::class, 'route2'])->name('route2');
Route::get('/route3', [ButtonController::class, 'route3'])->name('route3');

Route::get('/searchpage', [ButtonController::class, 'searchPage'])->name('searchpage');

// Medicine resource routes (CRUD)
Route::resource('medicines', MedicineController::class);

// Custom route for selling medicine
Route::post('medicines/{id}/sell', [MedicineController::class, 'sell'])->name('medicines.sell');

Route::get('/medicines/suggestions', [MedicineController::class, 'suggestions'])->name('medicines.suggestions');

Route::get('/search-medicines', [SearchController::class, 'search']);
Route::post('/buy-medicine/{id}', [SearchController::class, 'buy']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

// Add route for pharmacies index page
Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');

Route::resource('pharmacies', PharmacyController::class);

Route::get('/pharmacies/{pharmacy}/medicines', [PharmacyController::class, 'medicines'])->name('pharmacies.medicines');
Route::get('/pharmacies/{pharmacy}/medicines/{medicine}/add', [PharmacyController::class, 'addMedicineForm'])->name('pharmacies.addMedicineForm');
Route::post('/pharmacies/store_medicine', [PharmacyController::class, 'storeMedicine'])->name('pharmacies.store_medicine');
Route::post('/pharmacies/{medicine}/sell', [PharmacyController::class, 'sell'])->name('pharmacies.sell');
Route::delete('/pharmacies/{pharmacyMedicine}/destroy', [PharmacyController::class, 'destroyMedicine'])->name('pharmacies.destroyMedicine');

Route::get('/pharmacies/{pharmacyMedicine}/show', [PharmacyController::class, 'showMedicine'])->name('pharmacies.showMedicine');
Route::get('/pharmacies/{pharmacyMedicine}/edit', [PharmacyController::class, 'editMedicine'])->name('pharmacies.editMedicine');


