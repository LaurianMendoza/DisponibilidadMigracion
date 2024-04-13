<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'RH.empleado';

    protected $primaryKey = 'idempleado';
    public $timestamps = false;

    public function persona(){
        return $this->belongsTo(Persona::class, 'idpersona');
    }

    public function tipo_empleado(){
        return $this->belongsTo(Catalogo::class, 'tipo_empleado');
    }

    public function puesto(){
        return $this->belongsTo(Puestos::class, 'IdPuesto');
    }


}
