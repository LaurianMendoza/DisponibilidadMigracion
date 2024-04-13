<?php

use Illuminate\Support\Facades\Route;

Route::get('/Recursos-Humanos/Empleados',[App\Http\Controllers\ApartadoRecursosHumanos\EmpleadosController::class, 'showEmpleados'])->name('RH.empleados.showEmpleados');
