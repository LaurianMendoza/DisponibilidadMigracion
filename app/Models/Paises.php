<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;

    protected $table = 'Persona.Paises';

    protected $primaryKey = 'idPais';

    public $timestamps = false;
}
