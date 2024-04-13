<?php

namespace App\Exports\Docentes;

use App\Models\Documento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class listaAsistenciaExports implements FromView
{

    public function __construct($idGrupo){
        $this->idGrupo = $idGrupo;
    }

    public function view(): View{
        $grupo = DB::select('exec Escolares.spListaAsistenciaAlumnos2 @idGrupo='.$this->idGrupo);
        return view('Docentes.Reportes.Excel.ListaAsistencia',compact('grupo'));
    }

}
