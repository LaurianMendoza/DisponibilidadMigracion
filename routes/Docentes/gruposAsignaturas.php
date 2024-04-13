<?php

use Illuminate\Support\Facades\Route;

Route::get('/Docentes/Grupos-Asignaturas',
[App\Http\Controllers\ApartadoDocentes\GrupoAsignaturaController::class, 'index'])
->name('docentes.indexGruposAsignaturas');

