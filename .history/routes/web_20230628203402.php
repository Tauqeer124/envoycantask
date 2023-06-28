<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


//responsive image route
Route::get('/', [UserController::class, 'index'])->name('user.index');


Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/create', [UserController::class, 'create'])->name('user.create');
Route::post('/store', [UserController::class, 'store'])->name('user.store');
Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

