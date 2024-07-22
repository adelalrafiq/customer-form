<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('/form');
});
Route::get('/form', [CustomerController::class, 'create'])->name('form');
Route::post('/form', [CustomerController::class, 'store']);
Route::post('/file-upload', [CustomerController::class, 'uploadFile']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/customers', [AdminController::class, 'index'])->name('admin.customers');
    Route::post('/admin/customers/{customer}/update', [AdminController::class, 'update'])->name('admin.customers.update');
});
