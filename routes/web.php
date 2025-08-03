<?php

use App\Http\Controllers\CarsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('cars', CarsController::class);
