<?php


use App\Http\Controllers\SectionController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/section', [SectionController::class,'index']);
Route::get('/theme', [ThemeController::class,'index']);
Route::get('/book', [BookController::class,'index']);

//Untuk menyimpan data pakai post
Route::post('section', [SectionController::class,'store']);
Route::post('theme', [ThemeController::class,'store']);
Route::post('book', [BookController::class,'store']);

//Untuk mengupdate data pakai patch
Route::patch('section/{id}', [SectionController::class,'update']);
Route::patch('theme/{id}', [ThemeController::class,'update']);
Route::patch('book/{id}', [BookController::class,'update']);

//Untuk menghapus data pakai delete
Route::delete('book/{id}', [BookController::class,'destroy']);
Route::delete('theme/{id}', [ThemeController::class,'destroy']);
Route::delete('section/{id}', [SectionController::class,'destroy']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);