<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'Catalogos.General';

    protected $primaryKey = 'IdCatalogo';
    public $timestamps = false;
}
