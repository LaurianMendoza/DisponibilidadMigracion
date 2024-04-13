<?php

namespace App\Exports\Escolares;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class ListadoAspirantes implements FromView
{
    public $consulta;

    public function __construct($consulta){
        $this->consulta = $consulta;
    }

    public function view(): View{
        $consulta = $this->consulta;
        return view('ServiciosEscolares.Reportes.listadoAspirantes',compact('consulta'));
    }

}
