<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;
    protected $table = 'Escolares.Disponibilidad';

    protected $primaryKey = 'iddisponibilidad';

    public $timestamps = false;

    

}
