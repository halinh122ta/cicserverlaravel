<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\BankController;
use App\Http\Controllers\web\HistoriesController;
use App\Http\Controllers\web\TransactionController;
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
Route::get('/',[UserController::class, 'login'])->name('login');
Route::post('/',[UserController::class, 'loginPost'])->name('loginPost');

Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('/register',[UserController::class, 'registerPost'])->name('registerPost');

Route::get('logout',[UserController::class, 'logout'])->name('logout');
Route::middleware('authUser')->name('home.')->group(function(){
    Route::get('/home', [HomeController::class, 'homePage'])->name('index'); 
});
Route::middleware('authUser')->name('person.')->group(function(){
    Route::get('/person', [BankController::class, 'person'])->name('index'); 
});
Route::middleware('authUser')->name('bank.')->group(function(){
    Route::get('/bank', [BankController::class, 'index'])->name('index'); 
    Route::get('/create', [BankController::class, 'create'])->name('create'); 
    Route::get('/apply', [BankController::class, 'applyBill'])->name('applyBill'); 
});
Route::middleware('authUser')->name('price.')->group(function(){
    Route::get('/price', [BankController::class, 'price'])->name('index'); 
    Route::post('/price', [BankController::class, 'savePrice'])->name('savePrice'); 
});
Route::middleware('authUser')->name('histories.')->group(function(){
    Route::get('/history', [HistoriesController::class, 'index'])->name('index'); 
});
Route::middleware('authUser')->name('bit.')->group(function(){
    Route::get('/bit', [BankController::class, 'appvora'])->name('index'); 
});
Route::middleware('authUser')->name('check.')->group(function(){
    Route::get('/check', [TransactionController::class, 'full'])->name('index'); 
});