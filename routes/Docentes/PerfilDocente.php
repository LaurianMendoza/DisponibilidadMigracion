<?php
use Illuminate\Support\Facades\Route;


Route::get('/Docentes/Perfil',[App\Http\Controllers\PerfilUsuario\PerfilEmpleadoController::class, 'Perfil'])->name('Docente.Perfil');
Route::post('/Docentes/Perfil/ActualizarPersonales',[App\Http\Controllers\PerfilUsuario\PerfilEmpleadoController::class, 'ActualizarPersonales'])->name('Docente.ActualizarPersonales');
