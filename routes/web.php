<?php

use App\Http\Controllers\PromocionalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PromocionalController::class, 'create'])->name('promocionales.create');
Route::post('/promocionales', [PromocionalController::class, 'store'])->name('promocionales.store');
Route::get('/promocionales', [PromocionalController::class, 'index'])->name('promocionales.index');
Route::get('/promocionales/{id}/edit', [PromocionalController::class, 'edit'])->name('promocionales.edit');
Route::put('/promocionales/{id}', [PromocionalController::class, 'update'])->name('promocionales.update');
Route::delete('/promocionales/{id}', [PromocionalController::class, 'destroy'])->name('promocionales.destroy');
Route::delete('/promocional-fotos/{fotoId}', [PromocionalController::class, 'destroyPhoto'])->name('promocional-fotos.destroy');