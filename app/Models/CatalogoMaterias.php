<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoMaterias extends Model
{
    use HasFactory;

    protected $table = 'Catalogos.ClasificacionMaterias';

    protected $primaryKey = 'idCatalogo';
    public $timestamps = false;

}
