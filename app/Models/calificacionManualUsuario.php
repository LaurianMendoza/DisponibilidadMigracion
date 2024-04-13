<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacionManualUsuario extends Model
{
    use HasFactory;
    protected $table = 'Escolares.calificacionManualUsuario';

    protected $primaryKey = 'idCalifManual';

    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
