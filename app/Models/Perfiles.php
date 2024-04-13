<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;

    protected $table = 'Seguridad.Perfiles';

    protected $primaryKey = 'idperfil';

    public $timestamps = false;


    public function clasificacion(){
        return $this->belongsTo(CatalogoPerfiles::class, 'idClasificacion');
    }
}
