<?php

namespace App\Http\Controllers\PerfilUsuario;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilEmpleadoController extends Controller
{
    public function Perfil(){

        $datosPersona = Persona::where('idpersona',session('idPersona'))->get();

        $passcheck = 0;

        if(strcmp(session('active'), 'Docente') === 0){
            return view('Docentes.PerfilDocente.perfil', compact('passcheck', 'datosPersona'));
        }elseif(strcmp(session('active'), 'Administrativo') === 0){
            return view('Administrativo.Perfil.perfil', compact('passcheck', 'datosPersona'));
        }

    }

}
