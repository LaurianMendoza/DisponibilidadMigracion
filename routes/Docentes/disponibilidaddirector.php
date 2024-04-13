<?php

use Illuminate\Support\Facades\Route;

Route::get('/Docentes/DisponibilidadDirector', [App\Http\Controllers\DisponibilidadDirectorController::class, 'index'])->name('docentes.indexDisponibilidadDirector');

Route::get('/Docentes/visualizaciondispdirector/{idempleado}', [App\Http\Controllers\visualizaciondispdirectorcontroller::class, 'index'])->name('docentes.indexvisualizaciondispcontroller');
