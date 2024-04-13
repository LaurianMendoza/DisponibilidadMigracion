<?php

namespace App\Exports\Escolares\Excel;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class aspirantesCenevalExport implements FromView
{
    public $consulta;

    public function __construct($consulta){
        $this->consulta = $consulta;
    }

    public function view(): View{
        $consulta = $this->consulta;
        return view('ServiciosEscolares.ProcesoEscolar.Aspirantes.excel.plantillaAspirantesCeneval',
        compact('consulta'));
    }

}
