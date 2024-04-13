<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class visualizaciondispdirectorController extends Controller
{
    
    
    public function index($idempleado)
    {
        // Buscar la disponibilidad del empleado usando el ID
        $disponibilidad = DB::table('Escolares.Disponibilidad')
            ->where('idempleado', $idempleado)
            ->get();

        // Retornar la vista con los datos de disponibilidad
        return view('Docentes.visualizaciondispdirector', compact('disponibilidad'));
    }
      

    
  




}
