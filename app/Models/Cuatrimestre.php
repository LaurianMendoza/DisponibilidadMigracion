<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuatrimestre extends Model
{
    use HasFactory;
    protected $table = 'Escolares.cuatrimestre';

    protected $primaryKey = 'idcuatrimestre';

    public $timestamps = false;

    public function Estatus(){
        return $this->belongsTo(Catalogo::class, 'estatus');
    }
}
