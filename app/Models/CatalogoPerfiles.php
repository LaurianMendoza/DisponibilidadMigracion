<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoPerfiles extends Model
{
    use HasFactory;

    protected $table = 'Seguridad.Catalogo';

    protected $primaryKey = 'idCatalogo';

    public $timestamps = false;

}
