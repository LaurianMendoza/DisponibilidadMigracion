<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['recursosHumanos'])->group(function(){

Route::get('/Recursos-Humanos/Dashboard/',[App\Http\Controllers\ApartadoRecursosHumanos\RecursosHumanosController::class, 'dashboard'])->name('RH.dashboard');

//RUTAS PARA APARTADO DE ASPIRANTES PERSONALES
require __DIR__ . '/Empleados.php';

});
