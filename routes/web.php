<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\expeditionController;
use App\Http\Controllers\testController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('index');})->name("index");
Route::get('/dashboard',[expeditionController::class,'display'])->name("dashboard");
Route::get('/accueil',[testController::class,'display'])->name("accueil");
Route::get('/daterange', function () {return view('test');})->name('daterange');