<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

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

// Redirect '/' to the medicines index page
Route::get('/', function () {
    return redirect()->route('medicines.index');
});

// Medicine resource routes (CRUD)
Route::resource('medicines', MedicineController::class);

// Custom route for selling medicine
Route::post('medicines/{medicine}/sell', [MedicineController::class, 'sell'])->name('medicines.sell');
