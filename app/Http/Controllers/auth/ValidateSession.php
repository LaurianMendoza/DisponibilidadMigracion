<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Procesos\ControlEscolarController;
use App\Http\Controllers\Procesos\PeriodosEscolaresController;
use App\Models\logsSessions;
use App\Models\Persona;
use App\Models\SeguridadPermisosUsuarios;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ValidateSession extends Controller
{
    //

    public function index(){

        $this->validarPermisos();

        //primero valida si existe una sesion activa, validando si existe una variable
        //de sesion que se llame active y que sea igual a true
        //si existe y es igual a true retornara a la vista de home

        if(strcmp(session('active'), 'Admin') === 0){
            return redirect()->route('Admin.dashboard');

        }else if(strcmp(session('active'), 'Docente') === 0){
            return redirect()->route('docentes.index');

        }else if(strcmp(session('active'), 'RecursosHumanos') === 0){
            return redirect()->route('RH.dashboard');

        }else{
            //valida si existe una variable llamada LoginCheck, si no existe retorna al login
            if(!session()->has('LoginCheck')){
                return view('oldLogin');

            //si LoginCheck es igual a error_contra, retorna al login junto con la variable LoginCheck
            //para mostrar el mensaje de error cuando las contraseñas no coinciden
            }else if(session('LoginCheck')=='error'){
                $source = "error";
                return view('oldLogin')->with('LoginCheck',$source);


            //si LoginCheck es igual a error_Usuario, retorna al login junto con la variable LoginCheck
            //para mostrar el mensaje de error cuando el usuario no es encontrado o no existe
            }else if(session('LoginCheck')=='error_Contra'){
                $source =session('loginCheck');
                return view('oldLogin')->with('LoginCheck',$source);


            //si LoginCheck es igual a error_Usuario, retorna al login junto con la variable LoginCheck
            //para mostrar el mensaje de error cuando el usuario no es encontrado o no existe
            }else if(session('LoginCheck')=='error_Usuario'){
                $source =session('loginCheck');
                return view('oldLogin')->with('LoginCheck',$source);

            //si LoginCheck es igual a ok, retorna a la vista principal
            }else if(session('LoginDocenteCheck')=='ok'){
                $source =session('LoginDocenteCheck');
                return redirect()->route('docentes.index')->with('LoginDocenteCheck',$source);

            }else if(session('LoginCheckAdmin')=='ok'){
                $source =session('LoginCheckAdmin');
                return view('Administrador.home')->with('LoginCheckAdmin',$source);

            }else if(session('LoginCheck')=='ok'){
                $source =session('loginCheck');
                return view('home')->with('LoginCheck',$source);
            }
        }
    }

    //metodo para cerrar la sesion
    public function cerrarSesion(){
        if(session('idUsuario')){
            //DB::update("update Seguridad.Usuarios set fechaLogin = NULL where idUsuario = ".session('idUsuario')."");
            // Guarda la variable 'Idioma' antes de eliminar todas las demás variables de sesión
            $idioma = session('Idioma');
            session()->flush(); // Elimina todas las demás variables de sesión

            // Restaura la variable 'Idioma'
            session(['Idioma' => $idioma]);
            return redirect()->route('sesion');
        }else{
            // Guarda la variable 'Idioma' antes de eliminar todas las demás variables de sesión
            $idioma = session('Idioma');
            session()->flush(); // Elimina todas las demás variables de sesión

            // Restaura la variable 'Idioma'
            session(['Idioma' => $idioma]);
            return redirect()->route('sesion');
        }
    }

    public function cerrarSesionWithStrike(){
        if(session('idUsuario')){
            DB::update("update Seguridad.Usuarios set fechaLogin = NULL where idUsuario = ".session('idUsuario')."");
            $nuevoStrike = User::find(session('idUsuario'));
            $cantStrikes = (int)$nuevoStrike->strikes;

            if($cantStrikes == 0){ $nuevoStrike->strikes = 1; }
            else if($cantStrikes < 3){ $nuevoStrike->strikes = $nuevoStrike->strikes + 1; }

            try { $nuevoStrike->save();} catch (\Throwable $th) { }

            $idioma = session('Idioma');
            session()->flush(); // Elimina todas las demás variables de sesión

            // Restaura la variable 'Idioma'
            session(['Idioma' => $idioma]);
        }else{
            $nuevoStrike = User::find(session('idUsuario'));
            if(session('strikes') === 0){ $nuevoStrike->strikes = 1; }else{ $nuevoStrike->strikes = $nuevoStrike->strikes + 1; }
            try { $nuevoStrike->save(); } catch (\Throwable $th) { }

            // Guarda la variable 'Idioma' antes de eliminar todas las demás variables de sesión
            $idioma = session('Idioma');
            session()->flush(); // Elimina todas las demás variables de sesión

            // Restaura la variable 'Idioma'
            session(['Idioma' => $idioma]);
        }
    }

    //funcion que retorna al dashboard cuando se tiene una sesion iniciada
    //esto es para funcionalidad del menu
    public function redirectDash(){
        return redirect()->route('sesion');
    }


    public function breakSessionToInactivity(){
        session()->flush();
        return redirect()->route('sesion');
    }

    public function cleanSomeSessionVars(){
        session()->forget('cantMateriasSeleccionadas');
    }

    public function modoDocente(){
        session(["active" => 'Docente']);
        return redirect()->route('sesion');
    }

    public function modoEscolares(){
        session(["active" => 'Escolares']);
        return redirect()->route('sesion');
    }

    public function modoAdmin(){
        session(["active" => 'Admin']);
        return redirect()->route('sesion');
    }

    public function modoEstudiantiles(){

    }

    public function modoDirAcad(){
        session(["active" => 'DirAcad']);
        return redirect()->route('sesion');
    }

    public function modoOriginal(){
        session(["active" => session('activeOld')]);
        return redirect()->route('sesion');
    }

    public function validarPermisos(){
        $admin = 0;
        $escolares = 0;
        $vinculacion = 0;
        $DirAcad = 0;
        $estudiantiles = 0;
        $rh = 0;




    }


    public function noJavascript(){
        return view('noScript');
    }


}
