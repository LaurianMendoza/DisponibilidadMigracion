<?php

namespace App\Http\Controllers\ApartadoDocentes;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilDocenteController extends Controller
{
    public function PerfilDocente(){

        $datosPersona = Persona::where('idpersona',session('idPersona'))->get();

        $passcheck = 0;
        return view('Docentes.PerfilDocente.perfil', compact('passcheck', 'datosPersona'));
    }

}
