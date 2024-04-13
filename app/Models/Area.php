<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'RH.area';

    protected $primaryKey = 'idarea';

    public $timestamps = false;

    public function dependencia(){
        return $this->belongsTo(Area::class, 'iddependencia');
    }

}
