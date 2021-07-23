<?php

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

Route::get('/', function () {return view('pages/home');});

//Clients
Route::prefix('clients')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientController::class, 'home'])->name('clients');
    Route::post('/new', [App\Http\Controllers\ClientController::class, 'new']);
    Route::post('/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit']);
    Route::post('/delete/{id}', [App\Http\Controllers\ClientController::class, 'delete']);
});

//Payments
Route::prefix('payments')->group(function () {
    Route::get('/', [App\Http\Controllers\PaymentController::class, 'home'])->name('payments');
    Route::post('/new', [App\Http\Controllers\PaymentController::class, 'new']);
    Route::post('/edit/{id}', [App\Http\Controllers\PaymentController::class, 'edit']);
    Route::post('/delete/{id}', [App\Http\Controllers\PaymentController::class, 'delete']);
    Route::post('/latest', [App\Http\Controllers\PaymentController::class, 'latestPayments']);
    Route::get('/export', [App\Http\Controllers\PaymentController::class, 'export']);

});
