<?php

namespace App\Http\Controllers;

use App\Models\JaguarBot;
use App\Models\jaguarBot_PreguntasNoEncontradas;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class BotController extends Controller
{

    public function runPoliBot(){
        $nombrePersona = Persona::where('idpersona',session('idPersona'))->get();
        return view('Alumno.chatBot',compact('nombrePersona'));

    }

    public function SearchRequest(Request $request){
        $consulta = [];

        $consulta = DB::select("select * from Seguridad.jaguarBot");

        return response()->json([$consulta]);
    }

    public function SaveRequest(Request $request){
        $preguntaRespuesta = explode('-',$request->arrayPreguntaRespuesta);
        $pregunta = preg_replace("/[^A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ,()\[\]]/", '', $preguntaRespuesta[0]);

        $newRequest = new JaguarBot();
        $newRequest->pregunta_palabraClave = $pregunta;
        $newRequest->respuesta = $preguntaRespuesta[1];
        $newRequest->fecha = date('Y-m-d');
        try {
            $newRequest->save();
            return response()->json(['ok']);
        } catch (\Throwable $th) {
            return response()->json([$th]);
        }
    }

    public function learnToRequestNoSearch(Request $request){
        $nuevaPregunta = new jaguarBot_PreguntasNoEncontradas();
        $nuevaPregunta->pregunta = $request->pregunta;
        $nuevaPregunta->idPersona = $request->Persona;
        $nuevaPregunta->fecha = date('Y-m-d');

        try {
            $nuevaPregunta->save();
            return response()->json(['ok']);
        } catch (\Throwable $th) {
            return response()->json(['error']);
        }
    }

    //funcion para retornar el periodo de estancias y estadias
    public function searchRequestPeriodoEstanciasEstadias(Request $request){
        $periodosEstancias = DB::select("SELECT fpp.IdFechasPEstancias, Fpp.IdMateria, m.nombre as materia,
        CONVERT(varchar(30), fpp.FechaInicioVisible, 103) AS FechaInicioVisible, CONVERT(varchar(30), fpp.FechaFinVisible, 103) AS FechaFinVisible
        FROM Vinculacion.FechasParaPeriodos Fpp
        INNER JOIN Escolares.materia m ON m.idmateria = fpp.IdMateria
        WHERE Activo = 1 ORDER BY CASE WHEN m.nombre = 'ESTADÍA' THEN 1 ELSE 0 END, m.nombre ASC");
        return response()->json([$periodosEstancias]);
    }

    //funcion para retornar el fin de cuatrimestre
    public function searchFinCuatri(Request $request){
        $finDeCuatri = DB::select("select c.idcuatrimestre,c.cuatrimestre, CONVERT(varchar(30), c.fechaFin, 103) AS fechaFin,
		(CONVERT(VARCHAR(10), DATEDIFF(DAY, GETDATE(), c.fechaFin)) + ' Días ' +
		CONVERT(VARCHAR(2), DATEPART(HOUR, DATEADD(SECOND, DATEDIFF(SECOND, GETDATE(), c.fechaFin), 0))) + ' Horas y ' +
		CONVERT(VARCHAR(2), DATEPART(MINUTE, DATEADD(SECOND, DATEDIFF(SECOND, GETDATE(), c.fechaFin), 0))) + ' Minutos')as tiempoRestante
		from Escolares.cuatrimestre c where c.estatus = 46");
        return response()->json([$finDeCuatri]);
    }

    //funcion para saber si el alumno es regular o especial
    public function estatusAlumnoEspecialRegular(Request $request){
        $estatus = DB::select("SELECT CASE WHEN EXISTS (SELECT 1 FROM Escolares.alumno_especial ase WHERE ase.idalumno
        = ( SELECT a.idalumno FROM Escolares.alumno a WHERE a.idpersona = 13932 )
        AND ase.idcuatrimestre = (SELECT c.idcuatrimestre FROM Escolares.cuatrimestre c WHERE c.estatus = 46))
        THEN 'ALUMNO ESPECIAL'ELSE 'ALUMNO REGULAR'END AS estatusAlumno");
        return response()->json([$estatus]);
    }

    //funcion para saber quien es el director de la carrera del alumno
    public function searchDirCarrera(Request $request){

        $director = DB::select("SELECT CONCAT(p.nombre, ' ', p.paterno, ' ', p.materno) AS Director,
        CONCAT(Su.Usuario,'@upv.edu.mx')as correo, c.nombre as carrera
        FROM rh.empleado rhE
        JOIN Seguridad.Usuarios Su on Su.idPersona = rhE.idpersona
        JOIN Escolares.carrera c ON rhE.idempleado = c.idDirector
        JOIN Escolares.plan_estudios pe ON c.idcarrera = pe.idcarrera
        JOIN Escolares.AlumnoCarreras ac ON pe.idplan_estudios = ac.IdPlanEstudios
        JOIN Escolares.alumno a ON ac.IdAlumno = a.idalumno
        JOIN Persona.persona p ON rhE.idpersona = p.idpersona
        WHERE a.idpersona = :persona AND ac.Estatus = 12;",array(
            ':persona' => $request->Persona,
        ));
        return response()->json([$director]);
    }

    //funcion para saber si el alumno es candidato a practicas
    public function searchEstatusCandidatoPracticas(Request $request){
        $candidato = DB::select("select * from Vinculacion.CandidatosPracticas
        where idAlumno = (select a.idalumno from Escolares.alumno a where a.idpersona = :persona)
        and idCuatrimestre = (select fpc.IdCuatrimestre from Vinculacion.FechasPeriodosCandidatos fpc where activo = 1)",array(
            ':persona' =>$request->Persona,
        ));

        if(count($candidato) == 0){
            $candidato = '';
        }

        return response()->json([$candidato]);
    }

    //funcion para saber cuantas materias reprobadas tiene el alumno
    public function cantMateriasReprobadas(Request $request){
        $cantMateriasRep = 0;
        $materiasReprobadas = DB::select("SELECT DISTINCT ga.idgrupo, ga.idgrupo,ga.idmateria, m.nombre
        FROM Escolares.alumno a
        JOIN Escolares.AlumnoCarreras ac ON ac.IdAlumno = a.idalumno AND ac.Estatus = 12
        JOIN Escolares.grupo g ON g.idplan_estudios = ac.IdPlanEstudios
        JOIN Escolares.grupo_alumno ga ON ga.idgrupo = g.idgrupo AND ga.idalumno = a.idalumno and ga.baja = 0
        JOIN Escolares.materia m on m.idmateria = g.idmateria
        JOIN Escolares.cuatrimestre c ON c.idcuatrimestre = g.idcuatrimestre AND c.estatus = 46
        JOIN Escolares.grupo_Alumno_Calificaciones gac ON gac.idAlumno = ga.idalumno
        AND gac.idgrupo = ga.idgrupo and (gac.Calificacion < 70 and gac.Calificacion != 0)
        WHERE a.matricula = '2030125'");

        $cantMateriasRep = count($materiasReprobadas);

        if(count($materiasReprobadas) == 0){
            $cantMateriasRep = 0;
            $materiasReprobadas = '';
        }

        return response()->json([$materiasReprobadas,$cantMateriasRep]);

    }

    //funcion para saber quien es el tutor del alumno
    public function searchTutorEstudiante(Request $request){
        $consulta = DB::select("select (select p.nombre+' '+p.paterno+' '+p.materno from Persona.persona p where p.idpersona =
        (select e.idpersona from rh.empleado e where e.idempleado = Tta.idEmpleado))as Tutor,
        (select p.nombre+' '+p.paterno+' '+p.materno from Persona.persona p where p.idpersona =
        (select a.idpersona from Escolares.alumno a where a.idalumno = Tta.idAlumno))as Tutorado,
        Tta.idplan_estudios,(select pe.clave from Escolares.plan_estudios pe where pe.idplan_estudios = Tta.idplan_estudios)as PlanEstudio
        from Tutorias.TutorAlumnos Tta
        where idAlumno = (select a.idalumno from Escolares.alumno a where a.idpersona = :persona)",array(
            ":persona" => $request->Persona,
        ));
        return response()->json([$consulta]);
    }

    //funcion para saber si el alumno tiene numero de seguridad social,
    //cual es, y adonde acudir en caso de necesitar cambiarlo
    public function searchNSS_Estudiante(Request $request){

    }



    //funcion para saber fecha de reinscripciones y semana de altas y bajas

    //cuales son las responsabilidades de un alumno

    //cuales son los derechos de un alumno


}
