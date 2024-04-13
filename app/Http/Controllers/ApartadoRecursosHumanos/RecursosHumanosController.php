<?php

namespace App\Http\Controllers\ApartadoRecursosHumanos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncionesController;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class RecursosHumanosController extends Controller
{
    public function dashboard(){

        $totalEmpleadosActivos = Empleado::where("borrado",0)->orderBy("numero")->get();

        $empleadosXDepto = DB::select("SELECT a.nombre, COUNT(e.idarea) AS TotalXDepto
		FROM RH.empleado e JOIN Persona.persona p ON p.idpersona = e.idpersona
		JOIN RH.area a ON a.idarea = e.idarea JOIN RH.Puestos pe ON pe.IdPuesto = e.IdPuesto
		WHERE borrado = 0 GROUP BY a.idarea, a.nombre");

        $empleadosXPuesto = DB::select("SELECT COUNT(e.IdPuesto) AS TotalXPuesto, pe.Puesto
        FROM RH.empleado e JOIN Persona.persona p ON p.idpersona = e.idpersona
        JOIN RH.area a ON a.idarea = e.idarea JOIN RH.Puestos pe ON pe.IdPuesto = e.IdPuesto
        WHERE borrado = 0 GROUP BY pe.IdPuesto, pe.Puesto");

        return view('RecursosHumanos.Dashboard.dashboard',compact('totalEmpleadosActivos','empleadosXDepto','empleadosXPuesto'));
    }


}
