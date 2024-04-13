<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;

    protected $table = 'Persona.Estados';

    protected $primaryKey = 'idEstado';

    public $timestamps = false;

    public function pais(){
        return $this->belongsTo(Paises::class, 'idPais');
    }
}
