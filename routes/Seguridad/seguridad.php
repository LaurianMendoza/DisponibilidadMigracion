<?php
use Illuminate\Support\Facades\Route;


Route::get('/Validate/pin-code-session', [App\Http\Controllers\SeguridadController::class, 'index'])->name('seguridad.index');



