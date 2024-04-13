<?php

namespace App\Exports\Docentes;

use App\Models\GruposAlumno;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class PlantillaExcelCalificaciones implements FromView
{

    public function __construct($idGrupo, $unidades){
        $this->idGrupo = base64_decode($idGrupo);
        $this->unidades = $unidades;
    }

    public function view(): View{
        $unidades = $this->unidades;
        $idGrupo = $this->idGrupo;
        $grupo = DB::select('exec escolares.spGrupoCalifEditar @idGrupo='.$idGrupo);
        //$grupo = GruposAlumno::where('idgrupo',$idGrupo)->orderBy('noLista')->get();
        return view('Docentes.Reportes.Excel.PlantillaExcel',compact('grupo','unidades'));
    }
}
