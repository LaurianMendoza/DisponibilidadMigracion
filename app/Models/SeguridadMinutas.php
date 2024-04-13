<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguridadMinutas extends Model
{
    use HasFactory;
    protected $table = 'Seguridad.minutas';

    protected $primaryKey = 'idMinuta';

    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuarioAdminConf');
    }

}
