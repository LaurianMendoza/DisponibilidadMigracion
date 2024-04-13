<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'Persona.persona';

    protected $primaryKey = 'idpersona';

    public $timestamps = false;
    public function generos(){
        return $this->belongsTo(Catalogo::class, 'genero', 'IdCatalogo');
    }

    public function tipo_deSangre(){
        return $this->belongsTo(Catalogo::class, 'tipo_sangre', 'IdCatalogo');
    }

    public function estadocivil(){
        return $this->belongsTo(Catalogo::class, 'edo_civil', 'IdCatalogo');
    }

    public function estado(){
        return $this->belongsTo(Estados::class, 'EstadoNacimiento', 'idEstado');
    }
    public function estadoNac(){
        return $this->belongsTo(Estados::class, 'idestado_nac', 'idEstado');
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'MunicipioNacimiento', 'idmunicipio');
    }
}
