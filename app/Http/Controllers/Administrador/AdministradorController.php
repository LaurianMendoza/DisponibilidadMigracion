<?php
namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Empleado;
use App\Models\GrupoAlumnoCalificaciones;
use App\Models\logsSessions;
use App\Models\Persona;
use App\Models\SeguridadMinutas;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use stdClass;

class AdministradorController extends Controller{

    public function dashboard(){
        return view('Administrador.home');
    }


    public function listaUsuarios(){
        $Usuario = DB::select("select su.idUsuario, p.idpersona, rhE.idempleado,
        (p.nombre+' '+p.paterno+' '+p.materno)as nombre, Su.Usuario, Sp.Perfil,
        Su.Activo as UsuarioActivo, rhE.borrado as EmpleadoInactivo, Su.pinCodeActivo
        from Seguridad.Usuarios Su
        JOIN Seguridad.Perfiles Sp on Sp.idperfil = Su.idPerfil
        JOIN Persona.persona p on p.idpersona = Su.idPersona
        JOIN RH.empleado rhE on rhE.idpersona = Su.idPersona
        ORDER BY Su.Activo DESC,rhE.borrado");

        return view('Administrador.Usuarios.showUsers',compact('Usuario'));
    }




}
