<?php

use Illuminate\Support\Facades\Route;

Route::get('/Docentes/Disponibilidad', [App\Http\Controllers\DisponibilidadController::class, 'index'])->name('docentes.indexDisponibilidad');
Route::post('/Disponibilidad/update', [App\Http\Controllers\DisponibilidadController::class, 'update'])->name('disponibilidad.update');
Route::post('/enviarestatus', [App\Http\Controllers\DisponibilidadController::class, 'enviarEstatus'])->name('enviarEstatus');
