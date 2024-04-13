<?php

namespace App\Exports\Vinculacion;

use App\Models\AlumnoRegistroProyecto;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class candidatosEstanciasEstadias implements FromView
{
    private $idCuatrimestre;

    public function __construct($idCuatrimestre){
        $this->idCuatrimestre = $idCuatrimestre;
    }

    public function view(): View
    {
        $arrCandidatos=[];

        $cantCandidatosE1 = 0;
        $cantCandidatosE2 = 0;
        $cantCandidatosEstadia = 0;

        $candidatos = DB::select("select cp.idAlumno, (p.nombre+' '+p.paterno+' '+p.materno)as alumno, a.matricula,
        cp.idPlanEstudio, (select subpem.clave from Escolares.plan_estudios subpem where subpem.idplan_estudios = cp.idPlanEstudio)clavePlan,
        cp.idMateria, (select m.nombre from Escolares.materia m where m.idmateria = cp.idMateria)as materia,
        cp.idCuatrimestre, (select c.cuatrimestre from Escolares.cuatrimestre c where c.idcuatrimestre = cp.idCuatrimestre)as Cuatri
        from Vinculacion.CandidatosPracticas cp
        JOIN Escolares.alumno a on a.idalumno = cp.idAlumno
        JOIN Persona.persona p on p.idpersona = a.idpersona
        where idCuatrimestre in (:cuatri)
        ORDER BY CASE cp.idMateria
        WHEN 219 THEN 1
        WHEN 220 THEN 2
        WHEN 124 THEN 3
        END, alumno",array(
            ':cuatri' =>  $this->idCuatrimestre
        ));

        foreach ($candidatos as $c) {
            $obj = new stdClass();

            $obj->idAlumno = $c->idAlumno;
            $obj->alumno = $c->alumno;
            $obj->matricula = $c->matricula;
            $obj->idPlanEstudio = $c->idPlanEstudio;
            $obj->clavePlan = $c->clavePlan;
            $obj->idMateria = $c->idMateria;
            $obj->materia = $c->materia;
            $obj->idCuatrimestre = $c->idCuatrimestre;
            $obj->Cuatri = $c->Cuatri;
            $obj->idEmpresa = 0;
            $obj->empresa = "--";
            $obj->idProyecto = 0;
            $obj->proyecto = "--";
            $obj->asesorEmpresarial = "--";

            $alumnoPreRegistro = AlumnoRegistroProyecto::where("idAlumno",$c->idAlumno)
            ->where("idPlanEstudio",$c->idPlanEstudio)
            ->where("idCuatrimestre", $c->idCuatrimestre)
            ->get();

            foreach ($alumnoPreRegistro as $apr) {
                $obj->idEmpresa = $apr->idEmpresa;
                $obj->empresa = $apr->empresa->NombreEmpresa;
                $obj->idProyecto = $apr->idAlumnoRegistroProyecto;
                $obj->proyecto = $apr->NombreProyecto;
                $obj->asesorEmpresarial = $apr->idAsesor;
            }


            if($c->idMateria == 219){
                $cantCandidatosE1++;
            }
            if($c->idMateria == 220){
                $cantCandidatosE2++;
            }
            if($c->idMateria == 124){
                $cantCandidatosEstadia++;
            }
            array_push($arrCandidatos,$obj);
        }

        $candidatos = $arrCandidatos;

        return view('Vinculacion.Reportes.Excel.CandidatosEstanciasEstadia',
        compact('candidatos','cantCandidatosE1','cantCandidatosE2','cantCandidatosEstadia'));
    }
}
