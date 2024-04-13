<?php

namespace App\Exports\Estudiantiles;

use App\Models\Carreras;
use App\Models\Documento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class ASEcompletoExports implements FromView
{
    public $carrera;

    public function __construct(int $carrera){
        $this->carrera = $carrera > 0 ? $carrera : null ;
    }

    public function view(): View{
        $filtro = isset($this->carrera) ? ' pe.idcarrera = '.$this->carrera.' AND' : '';
        $ase = DB::select("
        select
            a.matricula as Matricula,
            (
                p.paterno + ' ' + p.materno + ' ' + p.nombre
            ) as Alumno,
            (
                select
                (
                    p.nombre + ' ' + p.paterno + ' ' + p.materno
                ) as Tutor
                from
                    Tutorias.TutorAlumnos ta
                join RH.empleado e on e.idempleado = ta.idEmpleado
                join Persona.persona p on p.idpersona = e.idpersona
                where
                    ta.idAlumno = a.idalumno
            ) as Tutor,
            pe.clave as PlanEstudios,
            car.nombre as Carrera,
            camp.Campus as Sede,
            ae.mrep as ReprobadasCuatri,
            ae.mesp as MateriasEspecial,
            ae.Cuatri_PlanCarreraActual as CuatrisPlanActual,
            ae.Cuatri_PlanOCarrDife as CuatrisPrimerIngreso
        from
            Escolares.alumno_especial ae
        join Escolares.alumno a on a.idalumno = ae.idalumno
        join Persona.persona p on p.idpersona = ae.idpersona
        join Escolares.plan_estudios pe on pe.idplan_estudios = ae.idplan_estudios
        join Escolares.carrera car on car.idcarrera = pe.idcarrera
        join Escolares.aspirante asp on asp.idpersona = ae.idpersona
        join Escolares.Campus camp on camp.idCampus = asp.idCampus
        where
        ". $filtro ."
            ae.idcuatrimestre =
            (
                select idcuatrimestre
                from Escolares.cuatrimestre
                where estatus = 46
            )
            ORDER BY Alumno
    ");

        return view('Estudiantiles.AlumnosEspecial.Excel.ASEcompleto',compact('ase'));
    }

}
