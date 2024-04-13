<?php

namespace App\Exports\Docentes;

use App\Models\Documento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class reporteCandidatosEstancias implements FromView
{

    private $idDirpersona;

    public function __construct($idDirpersona){
        $this->idDirpersona = $idDirpersona;
    }

    public function view(): View{
        $alumnos = [];
        if($this->idDirpersona == 985){
            $alumnos = DB::select("select vcp.idAlumno,(select p.paterno+' '+p.materno+' '+p.nombre from Persona.persona p
            where idpersona = (select idpersona from Escolares.alumno where idalumno = Vcp.idAlumno))as Nombre,
            (select matricula from Escolares.alumno where idalumno = Vcp.idAlumno)as Matricula,
            Vcp.idPlanEstudio,
            (select clave from Escolares.plan_estudios where idplan_estudios = Vcp.idPlanEstudio)as PlanEstudio,
            Vcp.idMateria,
            (select nombre from Escolares.materia where idmateria = Vcp.idMateria)as Materia,
            Vcp.idEmpleadoAsesor,
            (select p.nombre+' '+p.paterno+' '+p.materno from Persona.persona p
            where idpersona = (select idpersona from rh.empleado where idempleado = Vcp.idEmpleadoAsesor))as Asesor
            from Vinculacion.CandidatosPracticas  Vcp
            where idPlanEstudio in (26,35,70) and Vcp.activo = 1 and Vcp.idCuatrimestre in (select IdCuatrimestre from Vinculacion.FechasPeriodosCandidatos where activo = 1)
            ORDER BY Vcp.idPlanEstudio, idMateria");
        }else{
            $alumnos = DB::select("select vcp.idAlumno,(select p.paterno+' '+p.materno+' '+p.nombre from Persona.persona p
            where idpersona = (select idpersona from Escolares.alumno where idalumno = Vcp.idAlumno))as Nombre,
            (select matricula from Escolares.alumno where idalumno = Vcp.idAlumno)as Matricula,
            Vcp.idPlanEstudio,
            (select clave from Escolares.plan_estudios where idplan_estudios = Vcp.idPlanEstudio)as PlanEstudio,
            Vcp.idMateria,
            (select nombre from Escolares.materia where idmateria = Vcp.idMateria)as Materia,
            Vcp.idEmpleadoAsesor,
            (select p.nombre+' '+p.paterno+' '+p.materno from Persona.persona p
            where idpersona = (select idpersona from rh.empleado where idempleado = Vcp.idEmpleadoAsesor))as Asesor
            from Vinculacion.CandidatosPracticas  Vcp
            where idPlanEstudio in (select idplan_estudios from Escolares.plan_estudios
            where idcarrera in (select DISTINCT c.idcarrera from Escolares.plan_estudios pe JOIN Escolares.carrera c on c.idcarrera = pe.idcarrera
            JOIN RH.empleado e on e.idempleado = c.idDirector JOIN Seguridad.Usuarios u on u.idPersona = e.idpersona
            where c.idcarrera in(1,2,11,15,46,47,3) and u.Activo = 1 and e.idpersona = :persona))
            and idCuatrimestre in (select IdCuatrimestre from Vinculacion.FechasPeriodosCandidatos where activo = 1)
            and Vcp.activo = 1 ORDER BY Vcp.idPlanEstudio,idMateria",
            array(
                ':persona' => session("idPersona"),
            ));
        }

        return view('Docentes.Reportes.Excel.reporteCandidatosEstancias',compact('alumnos'));
    }

}
