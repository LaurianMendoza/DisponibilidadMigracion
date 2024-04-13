<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilFunciones extends Model
{
    use HasFactory;

    protected $table = 'Seguridad.PerfilesFunciones';

    protected $primaryKey = 'idPerfilFuncion';

    public $timestamps = false;


    public function perfil(){
        return $this->belongsTo(Perfiles::class, 'idPerfil');
    }

    public function funcion(){
        return $this->belongsTo(Funciones::class, 'idFuncion');
    }
}
