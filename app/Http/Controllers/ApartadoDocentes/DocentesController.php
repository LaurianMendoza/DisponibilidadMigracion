<?php

namespace App\Http\Controllers\ApartadoDocentes;

use App\Http\Controllers\Controller;
use App\Models\Cuatrimestre;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use stdClass;



class DocentesController extends Controller
{

    public function index()
    {
            $alumnos = [];
            $materiasImpartiendo = [];
            $profesor = [];
            $alumnosReprobados = [];
            $arrayAlumnosReprobados = [];
            $arrayHorasoCorridas = [];
            $arrayHorario = [];

            $cantAlumnosEstancias1= 0;
            $cantAlumnosEstancias1Tam= 0;

            $cantAlumnosEstancias2= 0;

            $profesor = Empleado::where('idpersona', session("idPersona"))->get();

            $materiasImpartiendo = DB::select("exec sp_executesql N'Select g.idgrupo, g.clave,g.idmateria,
                (SELECT escolares.feObtenerNombreMateria(0, g.idMateria))Materia FROM escolares.grupo g
                WHERE g.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46)
                AND g.idempleado = @idProfesor AND g.activo = 1
                AND g.idmateria not in (501,502,503,504,505,506,507,508,509,510,511)', N'@idProfesor int',@idProfesor=:profe",
                array(
                    ':profe' => $profesor[0]->idempleado
                )
            );



            $dias = array("DOMINGO", "LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SÁBADO");
            $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

            // echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            $hoy = $dias[date('w')];

            $arrayAlumnosReprobados = $this->elementosUnicos($arrayAlumnosReprobados);


            $siEsDir = [];


            $siEsDir = DB::select("select distinct e.idpersona, c.idcarrera, c.nombre,e.idempleado,c.siglas,
            (select nombre+' '+paterno+' '+materno from Persona.persona where idpersona = e.idpersona)as Director,
            e.idarea,(select a.nombre from rh.area a where idarea = e.idarea)as area
            from Escolares.plan_estudios pe JOIN Escolares.carrera c on c.idcarrera = pe.idcarrera
            JOIN RH.empleado e on e.idempleado = c.idDirector JOIN Seguridad.Usuarios u on u.idPersona = e.idpersona
            where c.idcarrera in(1,2,3,11,15,46,18,47) and u.Activo = 1 and e.idpersona = :persona",array(
                ':persona' => session("idPersona"),
            ));


            return view('Docentes.home');

    }


    function elementosUnicos($array)
    {
        $arraySinDuplicados = [];
        foreach ($array as $indice => $elemento) {
            if (!in_array($elemento, $arraySinDuplicados)) {
                $arraySinDuplicados[$indice] = $elemento;
            }
        }
        return $arraySinDuplicados;
    }


}
