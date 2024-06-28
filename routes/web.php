<?php

use App\Http\Controllers\SpkoController;
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

Route::get('/', [SpkoController::class, 'index'], function () {
    return view('index');
});
Route::get('/invoice/{id}', [SpkoController::class, 'invoice'], function () {
    return view('invoice');
});
Route::post('/create-transactions', [SpkoController::class, 'store'])->name('new.transaction');
Route::put('/edit-transactions/{id}', [SpkoController::class, 'update'])->name('edit.transaction');
Route::get('/edit/{id}', [SpkoController::class, 'edit']);
Route::delete('/delete-data/{id}', [SpkoController::class, 'destroy'])->name('destroy');
