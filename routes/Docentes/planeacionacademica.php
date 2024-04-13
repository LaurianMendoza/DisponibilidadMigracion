<?php

use Illuminate\Support\Facades\Route;

Route::get('/Docentes/PlaneacionAcademica', [App\Http\Controllers\PlaneacionAcademicaController::class, 'index'])->name('docentes.indexPlaneacionAcademica');