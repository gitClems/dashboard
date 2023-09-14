<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\expeditionController1;
use App\Http\Controllers\expeditionController;

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
Route::get('/dashboard',[expeditionController1::class,'display'])->name("dashboard");
Route::get('/accueil',[expeditionController::class,'display'])->name("accueil");
Route::get('/rapport', function () {return view('report');})->name('rapport');
Route::get('/register', function () {return view('register');})->name('daterange');