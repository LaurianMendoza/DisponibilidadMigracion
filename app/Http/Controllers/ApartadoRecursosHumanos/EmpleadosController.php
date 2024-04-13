<?php

namespace App\Http\Controllers\ApartadoRecursosHumanos;

use App\Http\Controllers\auth\CuentasUsuario;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Catalogo;
use App\Models\Cuatrimestre;
use App\Models\Empleado;
use App\Models\Estados;
use App\Models\Municipios;
use App\Models\Paises;
use App\Models\Perfiles;
use App\Models\Persona;
use App\Models\Puestos;
use App\Models\User;
use App\Models\GradoAcademico;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class EmpleadosController extends Controller
{

    public function showEmpleados(){

        $empleados = DB::select("select rhe.idempleado,rhe.numero,(p.nombre+' '+p.paterno+' '+p.materno)as Empleado, rhe.borrado,
        rhP.Puesto, rhA.nombre as Area, (select count(*) from Escolares.grupo where idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46)
        and idempleado = rhe.idempleado)as EsDocente
        from rh.empleado rhe
        JOIN Persona.persona p on p.idpersona = rhe.idpersona
        JOIN RH.Puestos rhP on rhP.IdPuesto = rhe.IdPuesto
        JOIN RH.area rhA on rhA.idarea = rhe.idarea
        ORDER BY rhe.numero");


        $cuatriActual = Cuatrimestre::where('estatus',46)->get();

        return view('RecursosHumanos.Empleados.showEmpleados',compact('empleados','cuatriActual'));
    }

    public function showFormAddEmpleado(){

        $genero = Catalogo::where('Clasificacion',1)->get();
        $tiposSangre = Catalogo::where('Clasificacion',19)->get();
        $estadoCivil = Catalogo::where('Clasificacion',5)->get();
        $gradoAcademico = GradoAcademico::all();
        $tiposEmpleados = Catalogo::where('Clasificacion',11)->get();
        $puestos = Puestos::all();
        $areas = Area::all();
        $paises = Paises::all();
        $perfil = Perfiles::whereIn('idperfil', [9, 26, 4, 10])->get();

        $ultimoEmpleadoRegistrado = [];
        $ultimoEmpleadoRegistrado = DB::select("select TOP 1 numero from RH.empleado ORDER BY idempleado DESC");
        $ultimoNumEmpelado = $ultimoEmpleadoRegistrado[0]->numero + 1;



        return view('RecursosHumanos.Empleados.addEmpleado'
        ,compact('genero','tiposSangre','estadoCivil','gradoAcademico'
        ,'puestos','areas','tiposEmpleados','paises','ultimoNumEmpelado','perfil'));
    }

    public function addEmpleado(Request $request){

        $ultimoEmpleadoRegistrado = [];
        $usuarioGen = [];
        $ultimaPersonaReg = [];
        $ultimoEmpleadoRegistrado = DB::select("select TOP 1 numero from RH.empleado ORDER BY idempleado DESC");
        $nuevoNumeroEmpleado = $ultimoEmpleadoRegistrado[0]->numero + 1;

        //estructura de datos de persona
        $persona = new Persona();
        $persona->nombre = $request->nombreEmpleado;
        $persona->paterno = $request->paternoEmpleado;
        $persona->materno = $request->maternoEmpleado;
        $persona->genero = $request->generoEmpleado;
        $persona->fecha_nac = $request->fechaNacEmpleado;
        $persona->curp = $request->curpEmpleado;
        $persona->email = $request->correoEmpleado;
        $persona->edo_civil = $request->estadoCivilEmpleado;
        $persona->tel_casa = $request->telCasaEmpleado;
        $persona->tel_cel = $request->telCelEmpleado;
        $persona->tel_otro = $request->telOtroEmpleado;
        $persona->tipo_sangre = $request->tipoSangreEmpleado;
        $persona->idestado_nac = $request->estadoAdd;
        $persona->EstadoNacimiento = $request->estadoAdd;
        $persona->MunicipioNacimiento = $request->municipioAdd;
        if(isset($request->esPadreMadre) || $request->esPadreMadre != null || $request->esPadreMadre != "" || $request->esPadreMadre == "on"){ $persona->esPadre = 1; }else{ $persona->esPadre = 0; }

        //estructura de datos de empleado
        $empleado = new Empleado();
        $empleado->numero = $nuevoNumeroEmpleado;
        $empleado->idGrado = $request->gradoAcadEmpleado;
        $empleado->siglas_grado = $request->siglasGradoAcadEmpleado;
        $empleado->rfc = $request->rfcEmpleado;
        if(isset($request->esTitulado) || $request->esTitulado != null || $request->esTitulado != "" || $request->esTitulado == "on"){ $empleado->titulado = 1; }else{ $empleado->titulado = 0; }
        $empleado->idarea = $request->areaEmpleado;

        $empleado->tipo_empleado = $request->tipoEmpleado;

        if($request->tipoEmpleado == 35 || $request->tipoEmpleado == 37){ $empleado->perfil_docente = 1; }else{ $empleado->perfil_docente = 0; }

        $empleado->fecha_ingreso = date('Y-m-d');
        if(isset($request->empleadoInactivo) || $request->empleadoInactivo != null || $request->empleadoInactivo != "" || $request->empleadoInactivo == "on"){ $empleado->borrado = 1; }else{ $empleado->borrado = 0; }
        $empleado->IdPuesto = $request->puesto;

        //Se inicia un beginTransaction
        DB::beginTransaction();

        try {
            $persona->save();
            $ultimaPersonaReg = DB::select("select TOP 1 idpersona from Persona.persona WHERE idpersona = ".$persona->idpersona." ORDER BY idpersona DESC");
            $comprobacionEmpleadoExistente = Empleado::where('idpersona',$ultimaPersonaReg[0]->idpersona)->get();

            if(count($comprobacionEmpleadoExistente) >= 1){
                return redirect()->route('RH.empleados.showEmpleados')->with('addEmpleado','existe');
            }else{
                try {
                    $empleado->idpersona = $ultimaPersonaReg[0]->idpersona;
                    $empleado->save();

                        $usuarioGen = DB::select("exec RH.pajUsuarioContraseña_NuevoEmpleado :numEmpelado",array(
                            ':numEmpelado' => $nuevoNumeroEmpleado,
                        ));

                        $ultimoEmpleadoRegistrado = DB::select("select TOP 1 * from RH.empleado where idempleado = ".$empleado->idempleado." ORDER BY idempleado DESC");
                        try {
                            //echo $usuarioGen[0]->Usuario ."-------";
                            //echo $usuarioGen[0]->Contraseña;


                            //Se llama al metodo que genera la contraseña
                            $cuentasUsuarios = new CuentasUsuario();
                            $pass = $cuentasUsuarios->GenerarPassAleatorio($persona->paterno);


                            $crearUsuario = DB::insert("insert into Seguridad.Usuarios(idPersona,Usuario,Contraseña, Activo,
                            idPerfil, Actualizado,estatusEvento) values(:idPersona, LOWER(:ususario), EncryptByAsymKey(AsymKey_ID('ClaveAsym'), '".$pass."'), :activo,
                            :perfil, :fechaActualizacion,:estatusEvento);",array(
                                ':idPersona' => $ultimaPersonaReg[0]->idpersona,
                                ':ususario' => $usuarioGen[0]->Usuario,
                                //':contra' => $usuarioGen[0]->Contraseña,
                                ':activo' => 1,
                                ':perfil' => $request->perfil,
                                ':fechaActualizacion' => date('Y-m-d H:m:s'),
                                ':estatusEvento' => 0,
                            ));
                            DB::commit();

                            return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($empleado->idempleado)])->with('editEmpleado','ok');

                        } catch (\Throwable $th) {
                           //echo "error usuario";
                            //echo $th;
                            DB::rollback();
                            return redirect()->route('RH.empleados.showEmpleados')->with('addEmpleado','error');
                        }
                } catch (\Throwable $th) {
                    //echo "error empleado";
                    //echo $th;
                    DB::rollback();
                    return redirect()->route('RH.empleados.showEmpleados')->with('addEmpleado','error');
                }
            }

        } catch (\Throwable $th) {
            //echo "error persona";
          //echo $th;
            DB::rollback();
            return redirect()->route('RH.empleados.showEmpleados')->with('addPersona','error');
        }


    }


    public function requestInfoEmpeladoAjax(Request $request){
        $arrayDatos= [];
        $CurpDato = $request->curp;
        $usuario = 'yashub';
        $contrasenia = 'Monodelodo98';
        $valor = $CurpDato; //entra el valor de la curp
        $metodo = 'curp';
        $url = 'https://conectame.ddns.net/rest/api.php?m=' . $metodo . '&user=' . $usuario . '&pass=' . $contrasenia . '&val=' . $valor;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_respuesta = curl_exec($curl);
        if ($curl_respuesta === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);

            //mensaje para insertar en el log de Aspirantes
            $contLog = "ERROR DE CONEXION CON LA API DE LAS CURPS (conectame.ddns.net)";
            //$this->addLog($contLog);

            die('Ocurrio un error: ' . var_export($info));
        }

        curl_close($curl);
        $curp = json_decode($curl_respuesta);


        if ($curp->Response == "Error"){
            return response()->json(['error']);
        } elseif ($curp->Response == "correct") {
            if ($curp->Sexo == "H") {
                $genero = 1;
            } else if ($curp->Sexo == "M") {
                $genero = 2;
            }
            $datos = new stdClass();
            $datos->Nombre = $curp->Nombre;
            $datos->Paterno = $curp->Paterno;
            $datos->Materno = $curp->Materno;
            $datos->FechaNacimiento = $curp->FechaNacimiento;
            $datos->Sexo = $genero;
            $idPaisDelEstado = [];

            $idPaisDelEstado = Estados::where('idEstado',$curp->NumEntidadReg)->get();
            $datos->Pais = $idPaisDelEstado[0]->idPais;
            $datos->Estado = $curp->NumEntidadReg;

            $idPaisDelEstado = [];
            $idPaisDelEstado = Municipios::where('clave',$curp->CveMunicipioReg)->where('idEstado',$curp->NumEntidadReg)->get();
            $datos->Ciudad = $idPaisDelEstado[0]->idmunicipio;

            $datos->Rfc = $curp->DatosFiscales->Rfc;
            array_push($arrayDatos,$datos);

            return response()->json([$arrayDatos]);
        }
    }


    public function showFormEditEmpleado($idEmpleado){

        $idEmpleado = base64_decode($idEmpleado);

        $empleado = [];
        $empleado = Empleado::where('idempleado',$idEmpleado )->get();
        $perfilEmpleado = DB::select("select idPerfil, idPerfil from Seguridad.Usuarios where idPersona = ".$empleado[0]->persona->idpersona."");
        $genero = Catalogo::where('Clasificacion',1)->get();
        $tiposSangre = Catalogo::where('Clasificacion',19)->get();
        $estadoCivil = Catalogo::where('Clasificacion',5)->get();
        $tiposEmpleados = Catalogo::where('Clasificacion',11)->get();
        $puestos = Puestos::all();
        $areas = Area::all();
        $paises = Paises::all();

        //Se verifica si la variable $perfilEmpleado trae algun dato, de lo contrario le asignara el valor cero a idperfil
        if ($perfilEmpleado != []) {
            $idperfil = $perfilEmpleado[0]->idPerfil;
        } else {
            $idperfil = 0;
        }

        $perfil = Perfiles::whereIn('idperfil', [9, 26, 4, 10, $idperfil])->get();
        $gradoAcademico = GradoAcademico::all();

        $estados = Estados::get();
        $municipios = Municipios::where('idEstado', $empleado[0]->persona->idestado_nac)->get();

        //return $empleado[0]->tipo_empleado;

        $usuario = [];
        $usuario = DB::select("select e.idempleado, e.idpersona, ua.Usuario, REPLACE(ua.Usuario, 'ñ', 'n') as UsuarioCorreo
        from RH.empleado e
        join Persona.persona p on p.idpersona = e.idpersona
        join Seguridad.Usuarios ua on ua.idPersona = e.idpersona
        where ua.idpersona = ".$empleado[0]->idpersona."");

        if($usuario != []){
            $correo = $usuario[0]->UsuarioCorreo;
        }else{
            $correo = " ";
        }

        $DatosGoogle = "";

        $cuentasUsuarios = new CuentasUsuario();

        $verificaCorreo = $cuentasUsuarios->BuscarCuentaGoogle($correo);
        $DatosGoogle = $verificaCorreo->getData();



        return view('RecursosHumanos.Empleados.editEmpleado'
        ,compact('genero','tiposSangre','estadoCivil','gradoAcademico'
        ,'puestos','areas','tiposEmpleados','paises', 'estados', 'municipios','perfil','empleado', 'perfilEmpleado', 'usuario','DatosGoogle'));

    }


    public function updateEmpleado(Request $request){

        //Se inicia un beginTransaction
        DB::beginTransaction();

        try {

            $persona = Persona::find($request->idPersona);

            $persona->nombre = $request->nombreEmpleado;
            $persona->paterno = $request->paternoEmpleado;
            $persona->materno = $request->maternoEmpleado;
            $persona->genero = $request->generoEmpleado;
            $persona->fecha_nac = $request->fechaNacEmpleado;
            $persona->curp = $request->curpEmpleado;
            $persona->email = $request->correoEmpleado;
            $persona->edo_civil = $request->estadoCivilEmpleado;
            $persona->tel_casa = $request->telCasaEmpleado;
            $persona->tel_cel = $request->telCelEmpleado;
            $persona->tel_otro = $request->telOtroEmpleado;
            $persona->tipo_sangre = $request->tipoSangreEmpleado;
            $persona->idestado_nac = $request->estadoAdd;
            $persona->EstadoNacimiento = $request->estadoAdd;
            $persona->MunicipioNacimiento = $request->municipioAdd;
            if(isset($request->esPadreMadre) || $request->esPadreMadre != null || $request->esPadreMadre != "" || $request->esPadreMadre == "on"){ $persona->esPadre = 1; }else{ $persona->esPadre = 0; }

            $persona->save();

        } catch (\Throwable $th) {
            //En caso que ocurra un error en la inserción deshace los cambios
            DB::rollback();

            return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($request->idEmpleado)])->with('editEmpleado','error');
        }



        try {

            $empleado = Empleado::find($request->idEmpleado);

            $empleado->idGrado = $request->gradoAcadEmpleado;
            $empleado->siglas_grado = $request->siglasGradoAcadEmpleado;
            $empleado->rfc = $request->rfcEmpleado;
            if(isset($request->esTitulado) || $request->esTitulado != null || $request->esTitulado != "" || $request->esTitulado == "on"){ $empleado->titulado = 1; }else{ $empleado->titulado = 0; }
            $empleado->idarea = $request->areaEmpleado;
            if(isset($request->esDocente) || $request->esDocente != null || $request->esDocente != "" || $request->esDocente == "on"){ $empleado->perfil_docente = 1; }else{ $empleado->perfil_docente = 0; }

            $empleado->tipo_empleado = $request->tipoEmpleado;

            if($request->tipoEmpleado == 35 || $request->tipoEmpleado == 37){ $empleado->perfil_docente = 1; }else{ $empleado->perfil_docente = 0; }

            $empleado->fecha_ingreso = date('Y-m-d');
            if(isset($request->empleadoInactivo) || $request->empleadoInactivo != null || $request->empleadoInactivo != "" || $request->empleadoInactivo == "on"){ $empleado->borrado = 1; }else{ $empleado->borrado = 0; }
            $empleado->IdPuesto = $request->puesto;

            $empleado->save();

        } catch (\Throwable $th) {
            //En caso que ocurra un error en la inserción deshace los cambios
            DB::rollback();

            return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($request->idEmpleado)])->with('editEmpleado','error');
        }

        try {
            $usuario = User::where('idPersona', $persona->idpersona)->first();
            $usuario->idPerfil = $request->perfil;

            $usuario->save();

        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($request->idEmpleado)])->with('editEmpleado','error');
        }


        //Se inicia el proceso en dónde se verifica si existe la cuenta de correo electronico para saber si proceder a realizar modificaciones al usuario

        try {

            //Obtener las siglas del grado academico para colocarla al inicio del nombre del empleado
            $gradoAcad = DB::select("select * from RH.GradoAcademico where idGrado = $empleado->idGrado");


            $UnidadOrganizativa = "/PAdmin";

            //Obtener el puesto con su Unidad Organizativa de Google
            $uOrganizativa = [];
            $uOrganizativa = DB::select("select p.IdPuesto, p.Puesto, p.idUOrganizativa, cg.Nombre as UOrganizativa from RH.Puestos p
            join Catalogos.General cg on cg.IdCatalogo = p.idUOrganizativa
            where IdPuesto = ".$empleado->IdPuesto."
            order by p.idUOrganizativa");

            //Si no obtiene datos uOrganizativa se tiene que hacer la asignación mas manual en el caso de los profesores de asignatura y PA
            if($uOrganizativa == []){
                //Profesores de asignatura
                if (in_array($empleado->IdPuesto, [35, 36, 37])) {
                    if($empleado->borrado == 0){

                        if($empleado->idarea == 7){ //MECATRONICA
                            $UnidadOrganizativa = "/PAsignatura/IM";
                        }if($empleado->idarea == 8){ //ITI
                            $UnidadOrganizativa = "/PAsignatura/ITI";
                        }if($empleado->idarea == 9){ //MANUFACTURA
                            $UnidadOrganizativa = "/PAsignatura/ITM";
                        }if($empleado->idarea == 10){ //POSTGRADO
                            $UnidadOrganizativa = "/PAsignatura/MER";
                        }if($empleado->idarea == 19){ //LAYGE
                            $UnidadOrganizativa = "/PAsignatura/PYMES";
                        }if($empleado->idarea == 23){ //ISA
                            $UnidadOrganizativa = "/PAsignatura/ISA";
                        }if($empleado->idarea == 29){ //LCIA
                            $UnidadOrganizativa = "/PAsignatura/LCIA";
                        }if($empleado->idarea == 20){ //IDIOMAS
                            $UnidadOrganizativa = "/PAsignatura/IDIOMAS";
                        }
                    }elseif($empleado->borrado == 1){
                        $UnidadOrganizativa = "/Ex-PA";
                    }

                }

                //Profesores de tiempo completo
                elseif(in_array($empleado->IdPuesto, [31, 32, 33, 34, 47])) {
                    if($empleado->borrado == 0){

                        if($empleado->idarea == 7){ //MECATRONICA
                            $UnidadOrganizativa = "/PTCs/IM";
                        }if($empleado->idarea == 8){ //ITI
                            $UnidadOrganizativa = "/PTCs/ITI";
                        }if($empleado->idarea == 9){ //MANUFACTURA
                            $UnidadOrganizativa = "/PAsignatura/ITM";
                        }if($empleado->idarea == 19){ //LAYGE
                            $UnidadOrganizativa = "/PTCs/LAYGE";
                        }if($empleado->idarea == 23){ //ISA
                            $UnidadOrganizativa = "/PTCs/ISA";
                        }if($empleado->idarea == 29){ //LCIA
                            $UnidadOrganizativa = "/PTCs/LCIA";
                        }if($empleado->idarea == 20){ //IDIOMAS
                            $UnidadOrganizativa = "/PTCs/IDIOMAS";
                        }

                    }elseif($empleado->borrado == 1){
                        $UnidadOrganizativa = "/Ex-PTCs";
                    }
                }

            }else{
                if($empleado->borrado == 0){
                    $UnidadOrganizativa = $uOrganizativa[0]->UOrganizativa;
                }elseif($empleado->borrado == 1){
                    $UnidadOrganizativa = "/Exadmins";
                }

            }



            $usuario = [];
            $usuario = DB::select("select e.idempleado, e.idpersona, ua.Usuario, REPLACE(ua.Usuario, 'ñ', 'n') as UsuarioCorreo
            from RH.empleado e
            join Persona.persona p on p.idpersona = e.idpersona
            join Seguridad.Usuarios ua on ua.idPersona = e.idpersona
            where ua.idpersona = ".$persona->idpersona."");

            if($usuario != []){
                $correo = $usuario[0]->UsuarioCorreo;
            }else{
                $correo = " ";
            }

            $DatosGoogle = "";

            $cuentasUsuarios = new CuentasUsuario();

            $verificaCorreo = $cuentasUsuarios->BuscarCuentaGoogle($correo);
            $DatosGoogle = $verificaCorreo->getData();

            //Solo en dado caso de que la cuenta de google exista procederá a realizar la modificación de los datos en ella, de lo contrario solo lo hará en la base de datos del siisu
            if($DatosGoogle->idEstatus == 1){

                $ActualizarUsuario = new CuentasUsuario();

                $updateUsuario = $cuentasUsuarios->ActualizarUsuariosGoogle($usuario[0]->UsuarioCorreo.'@upv.edu.mx', $gradoAcad[0]->SiglasGrado .' '. $persona->nombre, $persona->paterno. ' ' . $persona->materno, $persona->email, $persona->tel_cel, $UnidadOrganizativa, $empleado->borrado);
                $InfoGoogle = $updateUsuario->getData();

            }

        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($request->idEmpleado)])->with('editEmpleado','error');
        }



        //Se confirman los cambios en la base de datos para guardarse
        DB::commit();

        return redirect()->route('RH.empleados.showFormEditEmpleado',[base64_encode($request->idEmpleado)])->with('editEmpleado','ok');


    }

}
