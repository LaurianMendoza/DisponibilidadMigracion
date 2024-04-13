<?php

namespace App\Exports\Docentes;

use App\Models\AlumnoMateriasReprobadas;
use App\Models\Documento;
use App\Models\RelacionTutores;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class listaTutorados implements FromView
{

    private $idEmpleado;

    public function __construct($idEmpleado){
        $this->idEmpleado = $idEmpleado;
    }

    public function view(): View{
        $idEmpleado = $this->idEmpleado;


        $arrListaTutorados = [];
        $tutorados = RelacionTutores::where('idEmpleado',$idEmpleado)->get();
        foreach ($tutorados as $tutorado) {
            $obj = new stdClass();
            $obj->idAlumno=$tutorado->idAlumno;
            $obj->especial = 0;
            $obj->cantMateriasRecursadas = 0;
            $alumno_Especial = DB::select('select * from Escolares.alumno_especial where idalumno = '.$tutorado->idAlumno.' and
            idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus=46)');
            if(count($alumno_Especial) > 0){ $obj->especial = 1; }
            $cantReprobadas = [];
            $cantReprobadas = AlumnoMateriasReprobadas::where('idAlumno',$tutorado->idAlumno)
            ->where('idPlanEstudios',$tutorado->idplan_estudios)->get();
            if(count($cantReprobadas) >= 1){
                $obj->cantMateriasRecursadas = $cantReprobadas[0]->NumReprobadas;
            }
            array_push($arrListaTutorados,$obj);
        }


        $validacionestutorados = $arrListaTutorados;


        return view('Docentes.Reportes.Excel.listaTutorados',compact('tutorados','validacionestutorados'));
    }

}
