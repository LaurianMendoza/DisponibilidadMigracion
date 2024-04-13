<?php

namespace App\Exports\Vinculacion;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class listaEmpresasReport implements FromView
{
    private $IdEstado;
    private $IdMunicipio;

    public function __construct($IdEstado, $IdMunicipio){
        $this->IdEstado = $IdEstado;
        $this->IdMunicipio = $IdMunicipio;
    }

    public function view(): View
    {

        $con1='';
        $con2='';
        $condicional ='';

        if($this->IdEstado != 2455 && $this->IdMunicipio != 0){
            $con1 = ' and ce.IdEstado = '.$this->IdEstado;
            $con2 = ' and ce.IdMunicipio = '.$this->IdMunicipio;
            $condicional = $con1."".$con2;
        }else if($this->IdEstado != 2455 && $this->IdMunicipio == 0){
            $con1 = ' and ce.IdEstado = '.$this->IdEstado;
            $condicional = $con1;
        }else if($this->IdEstado == 2455 && $this->IdMunicipio == 0){
            $con1 = ' and ce.IdEstado = 2455';
            $condicional = $con1."".$con2;
        }else if($this->IdEstado == 2455 && $this->IdMunicipio == 48355){
            $con1 = ' and ce.IdEstado = 2455';
            $con2 = ' and ce.IdMunicipio = 48355';
            $condicional = $con1."".$con2;

        }


        $consulta = DB::select('select ce.IdCatalogoEmpresa,ce.NombreEmpresa,pe.Nombre as Estado ,pm.Nombre as nombre,
        g.TipoSector as Sector,ce.Convenio, ce.Activa as EmpActi, ce.regimenFiscal from Vinculacion.CatalogoEmpresas_ ce
        join Vinculacion.Estados pe on ce.IdEstado = pe.IdEstado
        join Vinculacion.Ciudades pm on ce.IdMunicipio = pm.IdCiudad
        join Vinculacion.SectorEmpresarial g on ce.IdSectorEmpresarial = g.IdSectorEconomico
        where ce.Activa = 1 '.$condicional.' ORDER BY ce.NombreEmpresa ASC');

        return view('Vinculacion.Reportes.Excel.empresas', compact('consulta'));
    }
}
