<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    protected $table = 'Escolares.horario';

    protected $primaryKey = 'idhorario';

    public $timestamps = false;


    public function grupo(){
        return $this->belongsTo(Grupos::class,'idgrupo');
    }

    public function aula(){
        return $this->belongsTo(Aula::class,'idaula');
    }

}
