<?php

use Illuminate\Support\Facades\Route;

Route::get('/Docentes/Dashboard/',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'index'])->name('docentes.index');

Route::get('/Docentes/Dashboard/Descargar-Horario',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'descargarHorario'])->name('docentes.descargarHorario');

Route::put('/Docentes/Dashboard/select-tab',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'selectTab'])->name('docentes.selectTab');
Route::put('/Docentes/Dashboard/select-Subtab',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'selectSubTab'])->name('docentes.selectSubTab');


Route::put('/Docentes/Dashboard/seleccionar-grupo',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'alumnosReprobados'])->name('docentes.alumnosReprobados');

Route::get('/Docentes/GetFinCuatri/',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'returnFinCuatri'])->name('docentes.returnFinCuatri');
Route::get('/Docentes/GetDiasRestantesFinCuatri/',[App\Http\Controllers\ApartadoDocentes\DocentesController::class, 'returnDiasRestantesFinCuatri'])->name('docentes.returnDiasRestantesFinCuatri');

