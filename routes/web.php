<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return redirect('/form');
});
Route::get('/form', [CustomerController::class, 'create']);
Route::post('/form', [CustomerController::class, 'store']);
Route::post('/file-upload', [CustomerController::class, 'uploadFile']);
