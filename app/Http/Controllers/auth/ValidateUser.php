<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Funciones;
use App\Models\PerfilFunciones;
use App\Models\logsSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateUser extends Controller
{


    public function validar(Request $request){

        //se reciben el usuario y contraseña desde el formulario de inicio de sesion
        $user =$request->username;
        $pass =$request->password;

        /*$consultaEvento = DB::select('select * from Seguridad.Usuarios');
        foreach ($consultaEvento as $key) {
            echo $key->idUsuario;
            $actualizar = User::where('idUsuario',$key->idUsuario)->update([
                'estatusEvento' => 0,
            ]);
        }*/

        //$this->卵($user,$pass);

        //se crea la variable consulta como array, para validar posteriormente cuando
        //no se llegue a encontrar un registro que coincida con esas credenciales
        $consulta = [];

        //se ejecuta la consulta que trae las credenciales del usuario en base a su
        //nombre de usuario,(la consulta decodifica la contraseña ya que en la base de datos
        //esta se encuentra cifrada)
        $consulta = DB::select("
        SELECT u.idUsuario,
        (SELECT nombre from Persona.persona p where p.idPersona = u.idpersona)as Nombre,
		(SELECT (p.paterno + ' ' + p.materno) from Persona.persona p where p.idPersona = u.idpersona)as Apellidos,
        usuario,
        idPersona,
        Activo,
		(select Perfil from Seguridad.Perfiles where idperfil=u.idPerfil) as Perfil,
		idPerfil as idPerfil,
        Contraseña as Contraseña
        FROM Seguridad.Usuarios u
        WHERE u.activo = 1 AND u.idUsuario<>7 AND u.Usuario = '$user'
        ORDER BY idUsuario");


        //si la consulta si encuentra un registro
        if($consulta != []){
            //ciclo para recorrer el array que contiene la informacion del usuario
            foreach ($consulta as $key) {
                //se guarda el id, idpersona, nombre, apellidos, usuario en variables separadas
                //para posteriormente guardarlas en variables de sesion
                //la variable passBD servira para validar que las credenciales son correctas
                //y permitirle iniciar sesion al usuario
                $passBD = $key->Contraseña;
                $id = $key->idUsuario;
                $idpersona = $key->idPersona;
                $idPerfil = $key->idPerfil;
                $nombre = $key->Nombre;
                $apellidos = $key->Apellidos;
                $usuario = $key->usuario;
                $perfil = $key->Perfil;
                $activo = $key->Activo;

            }

            //si el usuario y la contraseñas coinciden con las que se encuentran en la BD
            //se guarda la informacion del usuario en variables de sesion y se redirecciona
            //a la ruta sesion que manda al controlador ValidateSession en su metodo index
            //con una variable de sesion llamada LoginCheck con el valor ok

            if($user == $usuario && $pass == $passBD && $activo==1){
                session(["idUsuario" => $id]);
                session(["idPersona" => $idpersona]);
                session(["UsuarioPerfil" => $perfil]);
                session(["idPerfil" => $idPerfil]);
                session(["Nombre" => $nombre]);
                session(["Apellidos" => $apellidos]);
                session(["user" => $usuario]);
                session(["pass" => $request->password]);
                session(["activeSession" => true]);


                $clientIP = request()->ip();
                $this->registerSession(session("user"),session("idPersona"),$clientIP);

                $hostname = gethostname();
                //echo $estatusEvento;


                $source="ok";

                    if($idPerfil == 9 || $idPerfil == 4 || $idPerfil == 24){
                        session(["active" => 'Docente']);
                        session(['activeOld' => session("active")]);


                        return redirect()->route('sesion')->with('LoginDocenteCheck',$source);
                    }else if($idPerfil == 28){
                        session(["active" => 'RecursosHumanos']);
                        session(['activeOld' => session("active")]);
                        return redirect()->route('sesion')->with('LoginCheck',$source);
                    }else if($idPerfil == 1){
                        session(["active" => 'Admin']);
                        session(['activeOld' => session("active")]);
                        return redirect()->route('sesion')->with('LoginCheckAdmin',$source);
                    }
                //}
                // si no coinciden las credenciales, se retorna a la ruta sesion a su metodo index
                //con una variable de sesion llamada LoginCheck con el valor error_Contra
            }else{
                $source="error_Contra";
                $source="error";
                return redirect()->route('sesion')->with('LoginCheck',$source);
            }

        //si la consulta no encuentra algun registro se retorna a la ruta sesion a su metodo index
        //con una variable de sesion llamada LoginCheck con el valor error_Usuario
        }else {
            $source="error_Usuario";
            //$source="error";
            return redirect()->route('sesion')->with('LoginCheck',$source);
        }
    }

    public function validarFuncionesPerfil($idPerfil){
        try {

            $funcionesUsuario = PerfilFunciones::where('idPerfil',$idPerfil)->get();
            $funcionesPrincipales = Funciones::where('idPadre',0)->where('esMenuPrincipal',1)->where('sistema',1)->get();


            foreach ($funcionesUsuario as $funciones) {
                session(["Seguridad_Permiso-".$funciones->funcion->idFuncion => 1]);
            }

            //foreach para crear las variables de sesion para las secciones principales de los menus
            foreach ($funcionesPrincipales as $principales) {
                foreach ($funcionesUsuario as $funciones) {
                    if($funciones->funcion->idPadre == $principales->idFuncion){
                        session(["Seguridad_Permiso-".$principales->idFuncion => 1]);
                        //echo "Funcion: ".$funciones->funcion->Funcion."->".$funciones->funcion->idPadre."<br>";
                    }
                }
            }

        } catch (\Throwable $th) {
            $source="error_Permisos";
            return redirect()->route('sesion')->with('LoginCheck',$source);

        }

    }

    //nadie sabe nadie supo
    public function 卵($user,$pass){
        if($user=="easter" && $pass="egg"){
            return redirect()->route('sesion')->with('卵1','ok');
        }
    }


    public function registerSession($usuario,$idpersona,$clientIP){
        $registrarSesion = new logsSessions();
        $registrarSesion->usuario = $usuario;
        $registrarSesion->idPersona = $idpersona;
        $registrarSesion->ipUsuario = $clientIP;
        $registrarSesion->fechaHora = date('Y-m-d H:i:s');
        try {
            $registrarSesion->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}
