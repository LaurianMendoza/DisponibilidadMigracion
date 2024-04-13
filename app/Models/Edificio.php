<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    protected $table = 'Escolares.Edificios';

    protected $primaryKey = 'idEdificio';

    public $timestamps = false;

}
