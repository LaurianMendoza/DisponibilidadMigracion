<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'Escolares.aula';

    protected $primaryKey = 'idaula';

    public $timestamps = false;


    public function edificio(){
        return $this->belongsTo(Edificio::class, 'idedificio');
    }

    public function tipo(){
        return $this->belongsTo(Catalogo::class, 'tipo');
    }
}
