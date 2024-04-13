<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'Escolares.materia';

    protected $primaryKey = 'idmateria';

    public $timestamps = false;

    public function descripcion(){
        return $this->belongsTo(CatalogoMaterias::class, 'idCatalogo');
    }
}
