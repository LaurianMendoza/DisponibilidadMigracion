<?php

use Illuminate\Support\Facades\Route;

Route::get('/Administrador/dashboard',[App\Http\Controllers\Administrador\AdministradorController::class, 'dashboard'])->name('Admin.dashboard');


