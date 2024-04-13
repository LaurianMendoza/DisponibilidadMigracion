<?php

namespace App\Exports\Docentes;

use App\Models\AlumnoEmpresa;
use App\Models\ContactoEmpresarial;
use App\Models\Documento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class reporteCartasGeneradas implements FromView
{

    private $planesEstudioDir;

    public function __construct($planesEstudioDir){
        $this->planesEstudioDir = $planesEstudioDir;
    }

    public function view(): View{
        $planStr = '';

        $newarr = [];

        foreach ($this->planesEstudioDir as $ped) {
            $listado = DB::select("SELECT ISNULL((select subAE.IdAlumnoEmpresa from Vinculacion.AlumnoEmpresa2_ subAE
            where subAE.IdMateria = subQuery.idmateria and subAE.IdCuatrimestre = i.idcuatrimestre
            and subAE.IdAlumno = a.idalumno and subAE.Activa = 1),0)as IdAlumnoEmpresa ,ac.IdPlanEstudios,
            a.idalumno, a.matricula, (p.nombre+' '+p.paterno+' '+p.materno) as Alumno, subQuery.idMateria,
            subQuery.Materia,(select CASE WHEN count(*) = 1 THEN 'GENERADA' WHEN
            count(*) = 0 THEN 'NO GENERADA' END from Vinculacion.AlumnoEmpresa2_ subAE
            where subAE.IdMateria = subQuery.idmateria
            and subAE.IdCuatrimestre = i.idcuatrimestre and subAE.IdAlumno = a.idalumno
            and subAE.Activa = 1)as generoCarta, i.idcuatrimestre
            FROM Escolares.inscripcion i
            JOIN Escolares.alumno a on a.idalumno = i.idalumno
            JOIN Escolares.AlumnoCarreras ac on ac.IdAlumno = a.idalumno
            JOIN Persona.persona p on p.idpersona= a.idpersona
            JOIN (SELECT subGA.idalumno, subG.idcuatrimestre, subGA.idmateria, subM.nombre as Materia
            FROM Escolares.grupo subG
            JOIN Escolares.grupo_alumno subGA on subGA.idgrupo = subG.idgrupo
            JOIN Escolares.materia subM on subM.idmateria = subG.idmateria
            WHERE subG.idmateria IN (219, 220, 124) AND subGA.baja = 0 ) AS subQuery
            ON subQuery.idalumno = a.idalumno
            AND subQuery.idcuatrimestre = i.idcuatrimestre
            WHERE i.idcuatrimestre = (SELECT subC.idcuatrimestre FROM Escolares.cuatrimestre subC
            WHERE subC.estatus = 46) AND i.academica = 1 AND i.financiera = 1 AND ac.Estatus = 12
            and i.idplan_estudios in (:plan)
            order by CASE subQuery.idmateria
            WHEN 219 THEN 1
            WHEN 220 THEN 2
            WHEN 124 THEN 3
            ELSE 4 -- Puedes agregar más casos si es necesario
            END,generoCarta",
            array(
                ':plan' => $ped->idplan_estudios,
            ));

            foreach ($listado as $l) {
                $obj = new stdClass();
                $obj->IdAlumnoEmpresa = $l->IdAlumnoEmpresa;
                $obj->IdPlanEstudios = $l->IdPlanEstudios;
                $obj->matricula = $l->matricula;
                $obj->idalumno = $l->idalumno;
                $obj->Alumno = $l->Alumno;
                $obj->idMateria = $l->idMateria;
                $obj->Materia = $l->Materia;
                $obj->generoCarta = $l->generoCarta;
                $obj->proyecto = '';
                $obj->empresa = '';
                $obj->asesorEmp = '';

                $registroProyecto = [];
                $registroProyecto = DB::select("select * from Vinculacion.AlumnoEmpresa2_ ae
                join Vinculacion.CatalogoEmpresas_ ce on ce.IdCatalogoEmpresa = ae.IdEmpresa
                where ae.IdAlumno = :alumno and ae.IdCuatrimestre = (select idcuatrimestre from
                Escolares.cuatrimestre where estatus = 46)",array(
                    ':alumno' => $l->idalumno,
                ));

                foreach ($registroProyecto as $rp) {
                    if(isset($rp->NombreProyecto)){
                        $obj->proyecto = $rp->NombreProyecto;
                    }

                    if(isset($rp->NombreEmpresa)){
                        $obj->empresa = $rp->NombreEmpresa;
                    }

                    if(isset($rp->idAsesor)){
                        $obj->asesorEmp = $rp->idAsesor;
                    }else if(isset($rp->idempleado)){
                        $obj->asesorEmp = $rp->idempleado;
                    }else if(isset($rp->IdContacto)){
                        $contacto = [];
                        $contacto = ContactoEmpresarial::where('IdContacto',$rp->IdContacto)->get();
                        $obj->asesorEmp = $contacto[0]->NombreContacto;

                    }


                }

                array_push($newarr,$obj);
            }
        }

        $listado = $newarr;

        return view('Docentes.Reportes.Excel.reporteCartasGeneradas',compact('listado'));
    }

}
