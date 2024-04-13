<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;
    protected $table = 'Escolares.grupo';

    protected $primaryKey = 'idgrupo';
    public $timestamps = false;

    public function materia(){
        return $this->belongsTo(Materia::class, 'idmateria');
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'idempleado');
    }

    public function cuatri(){
        return $this->belongsTo(Cuatrimestre::class, 'idcuatrimestre');
    }

    public function planEstudios(){
        return $this->belongsTo(PlanEstudios::class, 'idplan_estudios');
    }

    public function carga(){
        return $this->belongsTo(Carga::class, 'idcarga');
    }

}
