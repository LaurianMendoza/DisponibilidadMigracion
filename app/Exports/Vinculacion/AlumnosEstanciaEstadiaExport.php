<?php

namespace App\Exports\Vinculacion;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Cuatrimestre;
use stdClass;

class AlumnosEstanciaEstadiaExport implements FromView
{
    public $pIni;
    public $pFin;

    public function __construct(int $pIni, int $pFin){
        $this->pIni = !(is_null($pIni)) ? $pIni : 0 ;
        $this->pFin = !(is_null($pFin)) ? $pFin : 0 ;
    }

    public function view(): View{
        $cuatriActual = Cuatrimestre::where('estatus', 46)->get();
        if ( ($this->pFin < $this->pIni) || ($this->pIni == 0) || ($this->pFin == 0) )
            {
                $this->pFin = $cuatriActual[0]->idcuatrimestre;
                $this->pIni = $cuatriActual[0]->idcuatrimestre;
            }

        $datosTabla = DB::select("select( p.paterno + ' ' + p.materno + ' ' + p.nombre) Alumno,a.matricula,ae.NombreProyecto,
        (select subce.NombreContacto from Vinculacion.ContactoEmpresarial_ subce where subce.IdContacto = ae.idAsesor)as aI,
        car.nombre as Carrera, c.cuatrimestre as Cuatrimestre, m.nombre as TipoPractica,
        pa.Pais, es.Nombre as Estado, ci.Nombre as Ciudad, ce.NombreEmpresa as Empresa
        from Vinculacion.AlumnoEmpresa2_ ae
        join Escolares.alumno a on a.idalumno = ae.IdAlumno
        join Persona.persona p on p.idpersona = a.idpersona
        join Escolares.plan_estudios pe on pe.idplan_estudios = ae.IdPlanEstudios
        join Escolares.carrera car on car.idcarrera = pe.idcarrera
        join Escolares.materia m on m.idmateria = ae.IdMateria
        join Escolares.cuatrimestre c on c.idcuatrimestre = ae.IdCuatrimestre
        join Vinculacion.CatalogoEmpresas_ ce on ce.IdCatalogoEmpresa = ae.IdEmpresa
        join Vinculacion.Paises pa on pa.IdPais = ce.IdPais
        join Vinculacion.Estados es on es.IdEstado = ce.IdEstado
        join Vinculacion.Ciudades ci on ci.IdCiudad = ce.IdMunicipio
        where c.idcuatrimestre BETWEEN ". $this->pIni." and ". $this->pFin."
        and ae.Activa = 1 and ae.IdMateria in(219, 220, 124)
        order by Cuatrimestre, TipoPractica, Carrera, Alumno");

        return view('Vinculacion.Reportes.Excel.AlumnosEstanciaEstadiaExcel',compact('datosTabla'));
    }

}
