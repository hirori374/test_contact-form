<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvDownloadController;

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


Route::get('/', [ContactController::class,'index']);
Route::post('/confirm', [ContactController::class,'confirm']);
Route::post('/thanks', [ContactController::class,'store']);
Route::post('/', [ContactController::class,'correction']);
Route::middleware('auth')->group(function() {
    Route::get('/admin', [AuthController::class,'admin']);
});
Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class,'logout']);
});
Route::middleware('auth')->group(function() {
    Route::delete('/delete/{id}', [AuthController::class,'destroy']);
});
Route::middleware('auth')->group(function() {
    Route::post('/admin/search', [AuthController::class,'search']);
});
Route::middleware('auth')->group(function() {
    Route::get('/admin/reset', [AuthController::class,'reset']);
});
Route::middleware('auth')->group(function() {
    Route::get('/admin/export', [CsvDownloadController::class, 'export']);
});
