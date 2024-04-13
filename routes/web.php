<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::put('/crear-variables-de-session-de-idioma', function (Request $request) {
    session(["Idioma" => $request->idioma]);
    return response()->json($request->idioma);
})->name('changeIdioma');

Route::get('/', [App\Http\Controllers\auth\ValidateSession::class, 'index'])->name('sesion')->middleware('Idioma');

//RUTA PARA VALIDAR SI NO SE TIENE JAVASCRIPT ACTIVADO
Route::get('/Habilita-Javascript', [App\Http\Controllers\auth\ValidateSession::class, 'noJavascript'])->name('noJavascript');

//RUTA PARA EL OLD LOGIN
Route::get('/old', function(Request $request){
    return view('login');
})->name('old');

//RUTA PARA REDIRECCIONAR AL DASHBOARD DEPENDIENDO DE LA SESION INICIADA
Route::get('/Dashboard', [App\Http\Controllers\auth\ValidateSession::class, 'redirectDash'])->name('dashboard');

//RUTA PARA VALIDAR LAS CREDENCIALES DE INICIO DE SESION
Route::post('/Validar',[App\Http\Controllers\auth\ValidateUser::class, 'validar'])->name('login');

//RUTA PARA CERRAR SESION
Route::get('/Cerrar-Sesion',[App\Http\Controllers\auth\ValidateSession::class, 'cerrarSesion'])->name('logout');
Route::get('/Cerrar-Sesion-Strike',[App\Http\Controllers\auth\ValidateSession::class, 'cerrarSesionWithStrike'])->name('logoutStrike');

//RUTA PARA BORRAR ALGUNAS VARIABLES DE SESION QUE SON UTILIZADAS EN VISTAS
Route::get('/ClearSessions',[App\Http\Controllers\auth\ValidateSession::class, 'cleanSomeSessionVars'])->name('cleanSomeSessionVars');

Route::post('/Borrar-Mensaje-de-Sesion', function(Request $request){
    session()->forget($request->variableSesion);
})->name('borrarMensajeSesion');


//RUTA PARA EL MODO OSCURO
Route::put('/', function(Request $request){
    session(['dark_mode' => $request->modo]);
})->name('darkmode');



Route::middleware(['administrador'])->group(function(){
    //RUTAS PARA EL ROL DE ADMINISTRADOR
    require __DIR__ . '/Administrador/Administrador.php';
});



//ARCHIVO QUE CONTIENE LAS RUTAS PARA LOS DOCENTES
Route::middleware(['docentes'])->group(function(){
    require __DIR__ . '/Docentes/dashboard.php';
    require __DIR__ . '/Docentes/gruposAsignaturas.php';
    require __DIR__ . '/Docentes/PerfilDocente.php';
    require __DIR__ . '/Docentes/disponibilidad.php';
    require __DIR__ . '/Docentes/disponibilidaddirector.php';
    require __DIR__ . '/Docentes/planeacionacademica.php';
});



//RECURSOS HUMANOS
require __DIR__ . '/RecursosHumanos/RecursosHumanos.php';

