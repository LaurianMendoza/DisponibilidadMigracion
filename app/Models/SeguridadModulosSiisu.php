<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguridadModulosSiisu extends Model
{
    use HasFactory;

    protected $table = 'Seguridad.modulos_siisu';

    protected $primaryKey = 'idModuloSiisu';
    public $timestamps = false;

    public function padre(){
        return $this->belongsTo(SeguridadModulosSiisu::class, 'idPadre');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'idArea');
    }
}
