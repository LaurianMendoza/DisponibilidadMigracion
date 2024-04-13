<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Area;
use App\Models\User;

use Illuminate\Support\Facades\DB;



class DisponibilidadDirectorController extends Controller
{
    //
    public function index()
    {



        if(session('idPersona') == 830){ // Orozco

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 7
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }
        elseif(session('idPersona') == 576){ // Jasso

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 8
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }
        elseif(session('idPersona') == 3379){ // Estela

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 19
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }
        elseif(session('idPersona') == 13772){ // Peña

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 27
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }
        elseif(session('idPersona') == 985){ // Amparo

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 9
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }
        elseif(session('idPersona') == 4277){ // Amado

            $profesores = DB::select("SELECT (p.nombre + ' ' + p.paterno + ' ' + p.materno)nombre, e.numero, a.idarea, a.nombre AS Carrera, st.estatus, e.idempleado
            FROM RH.empleado e
            JOIN RH.area a ON a.idarea = e.idarea
            JOIN Persona.persona p ON p.idpersona = e.idpersona
            left join Escolares.Estatusdisp st on st.idempleado = e.idempleado
            WHERE e.idarea = 29
");

            return view('Docentes.disponibilidaddirector', compact('profesores'));
        }





    }
}
