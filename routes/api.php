<?php

use App\Http\Controllers\DestinationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/destinations', [DestinationsController::class,'index']);

Route::post('destinations', [DestinationsController::class,'store']);

Route::patch('destinations/{id}', [DestinationsController::class,'update']);
