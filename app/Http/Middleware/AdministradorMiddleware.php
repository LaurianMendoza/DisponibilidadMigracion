<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministradorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if(strcmp(session('active'), 'Admin') !== 0 || !isset(session('Nombre')[0])){
            return redirect()->route('sesion');
        }

        //Actualiza la fecha y hora cada que interactua con el sistema
        //DB::update("update Seguridad.Usuarios set fechaLogin = GETDATE() where idUsuario = ".session('idUsuario')."");

        return $next($request);
    }
}
