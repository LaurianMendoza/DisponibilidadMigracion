<?php
namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\GrupoAlumnoCalificaciones;
use App\Models\logsSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use stdClass;

class UsuariosPerfilesController extends Controller{

    public function index(){
        return view('Administrador.Perfiles.showUsuariosPerfiles');
    }

}
