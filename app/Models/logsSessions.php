<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logsSessions extends Model
{
    use HasFactory;

    protected $table = 'Seguridad.logsSessions';

    protected $primaryKey = 'idLog';

    public $timestamps = false;
}
