<?php

namespace App\Exports\Estudiantiles;

use App\Models\Carreras;
use App\Models\Documento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class ASEinmediatoExports implements FromView
{
    public $carrera;

    public function __construct(int $carrera){
        $this->carrera = $carrera > 0 ? $carrera : null ;
    }

    public function view(): View{
        $filtro = isset($this->carrera) ? ' pe.idcarrera = '.$this->carrera.' AND ' : '';
        /*
        $ase = DB::select("
        select a.matricula as Matricula,
            (p.paterno + ' ' + p.materno + ' ' + p.nombre) as Alumno,
            (select (p.nombre + ' ' + p.paterno + ' ' + p.materno) as Tutor from Tutorias.TutorAlumnos ta join RH.empleado e on e.idempleado = ta.idEmpleado join Persona.persona p on p.idpersona = e.idpersona where ta.idAlumno = a.idalumno) as Tutor,
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
            ae.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46) and
            ae.idalumno not in (select ae2.idalumno from Escolares.alumno_especial ae2 where ae2.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46)-1)
        ORDER BY Alumno
        ");
        */

        $ase = DB::select("Select ae.idalumno, ae.idcuatrimestre, a.matricula,
        (SELECT persona.feNombre(ae.idalumno, 1))Alumno, pe.clave,
        (SELECT persona.feNombre(ta .idEmpleado, 2))Tutor, ae.idplan_estudios,
        (SELECT Escolares.feObtenerSede (ae.idalumno))Sede, ae.mrep, ae.mesp,
        --ae.Cuatri_PlanCarreraActual,
        (select ac.NoReinscripciones from Escolares.AlumnoCarreras ac where ac.IdAlumno = a.idalumno and ac.IdPlanEstudios = ae.idplan_estudios)Cuatri_PlanCarreraActual,
        ae.Cuatri_PlanOCarrDife,
        ISNULL(ae.dictamen, 0)Dictamen,
        ae.resolucion as idResolucion,
        (Select cg.Nombre from Catalogos.General cg join Escolares.alumno_especial ae1 on ae1.Resolucion = cg.IdCatalogo where ae1.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46) and ae1.idalumno = ae.idalumno)Resolucion,
        ae.Observaciones from Escolares.alumno_especial ae
        join Escolares.alumno a on a.idalumno = ae.idalumno
        join Tutorias.TutorAlumnos ta on ae.idalumno = ta.idAlumno
        join Escolares.plan_estudios pe on pe.idplan_estudios = ae.idplan_estudios
        join Escolares.plan_estudios p on p.idplan_estudios = ae.IdPlan_Estudios
        join Escolares.carrera r on r.idcarrera = p.idcarrera
        where
		ae.IdCuatrimestre = (select ic.idcuatrimestre from Escolares.cuatrimestre ic where ic.estatus = 46)
        and ae.idalumno in(
		select distinct a.idalumno
from Escolares.alumno_especial ae
join Escolares.alumno a on a.idalumno = ae.idalumno
join Persona.persona p on p.idpersona = a.idpersona
join Escolares.cardex c on c.idalumno = ae.idalumno
where ae.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46) and c.idcuatrimestre_ult_insc = ((select idcuatrimestre from Escolares.cuatrimestre where estatus = 46)-1) and c.idplan_estudios = ae.idplan_estudios and c.calificacion = 60 and c.idplan_estudios not in(select epe.idplan_estudios from Escolares.plan_estudios epe where epe.idcarrera = 29)
and ((c.inscripciones >= 2 and c.calificacion = 60)
or ((select (select count(car.idalumno) from Escolares.cardex car where car.idalumno = ae.idalumno and car.idplan_estudios = ae.idplan_estudios and car.idcuatrimestre_ult_insc = ((select idcuatrimestre from Escolares.cuatrimestre where estatus = 46)-1) and car.calificacion = 60)) >= 4)
or (select ac.NoReinscripciones from Escolares.AlumnoCarreras ac where ac.IdAlumno = c.idalumno and ac.IdPlanEstudios = c.idplan_estudios) = 15)
		)
		order by clave, matricula");

        return view('Estudiantiles.AlumnosEspecial.Excel.ASEinmediatos',compact('ase'));
    }

}
