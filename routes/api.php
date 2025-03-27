<?php

use App\Http\Controllers\PromocionalController;
use Illuminate\Support\Facades\Route;

Route::get('/promocionales-destacados', [PromocionalController::class, 'apiIndex']);
Route::get('/promocionales-destacados/{id}', [PromocionalController::class, 'apiShow']);