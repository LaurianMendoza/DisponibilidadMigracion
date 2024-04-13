<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguridadPermisosUsuarios extends Model
{
    use HasFactory;
    protected $table = 'Seguridad.permisos_siisu';

    protected $primaryKey = 'idPermisoSiisu';
    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function usuarioConf(){
        return $this->belongsTo(User::class, 'idUsuarioAdminConf');
    }

    public function modulo(){
        return $this->belongsTo(SeguridadModulosSiisu::class, 'idModuloSiisu');
    }

    public function permisoPadre(){
        return $this->belongsTo(SeguridadPermisosUsuarios::class, 'idPadre');
    }

}
