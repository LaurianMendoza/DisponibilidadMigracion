<?php

namespace App\Http\Middleware;

use App\Http\Middleware\BaseMiddleware;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DocentesMiddleware
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
        if(strcmp(session('active'), 'Docente') !== 0 || !isset(session('Nombre')[0])){
            return redirect()->route('sesion');
        }
        //Actualiza la fecha y hora cada que interactua con el sistema
        //DB::update("update Seguridad.Usuarios set fechaLogin = GETDATE() where idUsuario = ".session('idUsuario')."");

        return $next($request);
    }
}
