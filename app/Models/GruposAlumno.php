<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GruposAlumno extends Model
{
    use HasFactory;
    protected $table = 'Escolares.grupo_alumno';

    protected $primaryKey = 'idgrupo';
    public $timestamps = false;

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'idalumno');
    }

    public function materia(){
        return $this->belongsTo(Materia::class, 'idmateria');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
