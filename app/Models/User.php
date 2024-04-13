<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
        protected $table = 'Seguridad.Usuarios';

        public $timestamps = false;

        protected $primaryKey = 'idUsuario';

        public function persona(){
            return $this->belongsTo(Persona::class, 'idPersona');
        }

        public function perfil(){
            return $this->belongsTo(Perfiles::class, 'idPerfil');
        }
}
