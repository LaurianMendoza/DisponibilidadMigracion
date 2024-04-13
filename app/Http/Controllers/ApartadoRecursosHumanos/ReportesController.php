<?php

namespace App\Http\Controllers\ApartadoRecursosHumanos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Cuatrimestre;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonImmutable;
use stdClass;

class ReportesController extends Controller
{
    public function horarioProfesor($idempleado = null, $Periodo = null){

        $idempleado = base64_decode($idempleado);
        $Periodo = base64_decode($Periodo);

        //Obtenemos el cuatri actual
        $cuatriActual = Cuatrimestre::where('estatus', 46)->get();

        if($Periodo == null){
            $Periodo = $cuatriActual[0]->idcuatrimestre;
        }

        //Obtener los profesores con cargas academicas
        $profesores = DB::select("exec sp_executesql N'SELECT e.idEmpleado, (SELECT Persona.feNombre(e.idEmpleado, 2))as empleado FROM RH.empleado e WHERE e.idempleado IN (SELECT g.idEmpleado FROM Escolares.grupo g WHERE g.idcuatrimestre=@idCuatrimestre AND g.activo = 1) ORDER BY (SELECT Persona.feNombre(e.idEmpleado, 2))',N'@idCuatrimestre int',@idCuatrimestre=".$Periodo."");

        //Obtenemos los periodos
        $cuatrimestre = Cuatrimestre::orderby('idcuatrimestre', 'desc')->get();

        return view('RecursosHumanos.Reportes.HorarioProfesores.horarioProfesor', compact('profesores', 'cuatrimestre', 'idempleado', 'Periodo', 'cuatriActual'));
    }


    public function buscar(Request $request){

        $idempleado = base64_encode($request->profesor);
        $idperiodo = base64_encode($request->periodo);

        if(session('active') == 'RecursosHumanos'){
            return redirect()->route('RH.reportes.horarioprofesor', [$idempleado, $idperiodo]);
        }elseif(session('active') == 'DirAcad'){
            return redirect()->route('DirAcad.reportes.horarioprofesor', [$idempleado, $idperiodo]);
        }

    }

    public function reporteHorarioProfesor($idempleado, $idperiodo){

        $profesor = [];
        $nombreProfe = [];

        $profesor = Empleado::where('idempleado', $idempleado)->get();

        $nombreProfe = Persona::where('idPersona', $profesor[0]->idpersona)->get();

        $periodoEscolar = Cuatrimestre::where('idcuatrimestre', $idperiodo)->get();

        $horarioDias = DB::select("SELECT distinct numDia, Dia
        FROM Escolares.ftHorarioXMaestro2($idempleado, $idperiodo, 0) AS ftHorarioXMaestro2_1
        ORDER BY numDia");

        $horarioHoras = DB::select("SELECT distinct horaInicio, horaFin, horaConcatenada
        FROM Escolares.ftHorarioXMaestro2($idempleado, $idperiodo, 0) AS ftHorarioXMaestro2_1");

        $horarioMaterias = DB::select("SELECT idTabla, idGrupo, idHorario, numDia, Dia, horaInicio, horaFin, idAula, Aula, idEdificio,
        Edificio, idMateria, Materia, horaConcatenada, claveGrupo, idPlanDeEstudios, idEmpleado, Empleado
        FROM Escolares.ftHorarioXMaestro2($idempleado, $idperiodo, 0) AS ftHorarioXMaestro2_1
        ORDER BY Empleado");



        //Manda a llamar la propiedad o libreria dompdf
        $dompdf = App::make("dompdf.wrapper");

        //Manda las variables a la vista
        $dompdf->loadView('RecursosHumanos.Reportes.HorarioProfesores.horarioProfesorpdf', compact('profesor', 'nombreProfe', 'periodoEscolar', 'horarioDias', 'horarioHoras', 'horarioMaterias'));

        //Tipo de papel, en este caso tamaño oficio
        $dompdf->setPaper('letter');

        //Retorna a la vista en formato pdf
        return $dompdf->stream('Horario de asignaturas - '.$nombreProfe[0]->nombre. ' ' .$nombreProfe[0]->paterno. ' ' .$nombreProfe[0]->materno.' .pdf');

    }

    public function reporteTodosHorarioProfesor($idempleado, $idperiodo){

        // Establecer el límite de tiempo a 60 segundos
        set_time_limit(300);

        /* $profesor = [];
        $nombreProfe = [];

        $profesor = Empleado::where('idempleado', $idempleado)->get();

        $nombreProfe = Persona::where('idPersona', $profesor[0]->idpersona)->get(); */
        $periodoEscolar = Cuatrimestre::where('idcuatrimestre', $idperiodo)->get();


        $profesor = DB::select("SELECT distinct h.idEmpleado, h.Empleado, e.numero
        FROM Escolares.ftHorarioXMaestro2(0, $idperiodo, 1) h
		join RH.empleado e on e.idempleado = h.idEmpleado
        ORDER BY e.numero");

        $horarioDias = DB::select("SELECT idEmpleado, numDia, Dia
        FROM Escolares.ftHorarioXMaestro2(0, $idperiodo, 1) AS ftHorarioXMaestro2_1
		GROUP BY idEmpleado, numDia, Dia
        ORDER BY idEmpleado, numDia");

        $horarioHoras = DB::select("SELECT idEmpleado, Empleado, horaInicio, horaFin, horaConcatenada
        FROM Escolares.ftHorarioXMaestro2(0, $idperiodo, 1) AS ftHorarioXMaestro2_1
        GROUP BY idEmpleado, Empleado, horaInicio, horaFin, horaConcatenada
        ORDER BY idEmpleado, horaInicio");

        $horarioMaterias = DB::select("SELECT idTabla, idGrupo, idHorario, numDia, Dia, horaInicio, horaFin, idAula, Aula, idEdificio,
        Edificio, idMateria, Materia, horaConcatenada, claveGrupo, idPlanDeEstudios, idEmpleado, Empleado
        FROM Escolares.ftHorarioXMaestro2(0, $idperiodo, 1) AS ftHorarioXMaestro2_1
        ORDER BY idEmpleado, numDia, horaInicio");



        //return view('RecursosHumanos.Reportes.HorarioProfesores.horarioTodosProfesorpdf', compact('periodoEscolar', 'profesor', 'horarioDias', 'horarioHoras', 'horarioMaterias'));


        //Manda a llamar la propiedad o libreria dompdf
        $dompdf = App::make("dompdf.wrapper");

        //Manda las variables a la vista
        $dompdf->loadView('RecursosHumanos.Reportes.HorarioProfesores.horarioTodosProfesorpdf', compact('periodoEscolar', 'profesor', 'horarioDias', 'horarioHoras', 'horarioMaterias'));

        //Tipo de papel, en este caso tamaño oficio
        $dompdf->setPaper('letter');

        //Retorna a la vista en formato pdf
        return $dompdf->stream('Horario de asignaturas - Profesores .pdf');


    }




    public function incidenciaSeleccion($idpersona = null, $fechaInicio = null, $fechaFin = null){

        $idpersona = base64_decode($idpersona);
        $fechaInicio = base64_decode($fechaInicio);
        $fechaFin = base64_decode($fechaFin);

        $empleados = DB::select("select AutoNum, IdPersona, IdEmpleado, Numero, Nombre, IdPuesto, Puesto, borrado, IdArea, Area, IdHorario, Horario
        from RH.fntjPersonal_Listado()
        where IdPersona not in (13757) and borrado = 0 order by Numero");

        return view('RecursosHumanos.Reportes.Incidencias.Seleccion.incidenciaSeleccion', compact('empleados', 'idpersona', 'fechaInicio', 'fechaFin'));
    }


    public function buscarIncidenciaSeleccion(Request $request){

        $idpersona = base64_encode($request->empleado);
        $fechaInicio = base64_encode($request->fechaInicio);
        $fechaFin = base64_encode($request->fechaFin);

        return redirect()->route('RH.reportes.incidenciaSeleccion', [$idpersona, $fechaInicio, $fechaFin]);

    }


    public function reporteIncidenciaSeleccion($idpersona, $fechaInicio, $fechaFin){

        $empleado = DB::select("select e.numero, (p.nombre + ' ' + p.paterno + ' ' + p.materno)Nombre
        from Persona.persona p
        join RH.empleado e on e.idpersona = p.idpersona
        where p.idpersona = $idpersona");

        $lista = DB::select("exec RH.pajRPTIncidencias_Seleccion @fechaInicio='$fechaInicio', @fechaFin='$fechaFin', @listado='$idpersona'");

        $conteos = DB::select("exec RH.pajRPTIncidenciasTotales_Seleccion @fechaInicio='$fechaInicio',@fechaFin='$fechaFin',
        @listado='$idpersona'");



        // Se cambia el formato de la fecha a formato de texto
        $tamañoLista = count($lista);
        for($i = 0; $i < $tamañoLista; $i++){

        setlocale(LC_TIME, 'es_ES');

        $fecha = $lista[$i]->Fecha;

        // Crear una instancia de Carbon a partir de la fecha
        $carbonFecha = Carbon::createFromFormat('Y-m-d', $fecha)->locale('es_ES');

        // Obtener el nombre del día de la semana y el día del mes
        $nombreDiaSemana = $carbonFecha->isoFormat('dddd');
        $diaMes = $carbonFecha->format('j');

        // Obtener el nombre del mes
        $nombreMes = $carbonFecha->isoFormat('MMMM');

        // Concatenar la información en el formato deseado
        $fechaFormateada = $nombreDiaSemana . ', ' . $diaMes . ' de ' . $nombreMes . ' de ' . $carbonFecha->year;

        // Imprimir la fecha formateada
        $lista[$i]->Fecha = $fechaFormateada;
        }



        //Manda a llamar la propiedad o libreria dompdf
        $dompdf = App::make("dompdf.wrapper");

        //Manda las variables a la vista
        $dompdf->loadView('RecursosHumanos.Reportes.Incidencias.Seleccion.incidenciaSeleccionpdf', compact('fechaInicio', 'fechaFin', 'empleado', 'lista', 'conteos'));

        //Tipo de papel, en este caso tamaño oficio
        $dompdf->setPaper('letter');

        //Retorna a la vista en formato pdf
        return $dompdf->stream('Incidencias '.$fechaInicio.' - '.$fechaFin.' .pdf');

    }


    public function reporteIncidenciaSeleccionTodos($idpersona, $fechaInicio, $fechaFin){

        //Aumentamos el tiempo de espera a 2 minutos ya que las consultas son algo pesadas y se tarda mas de lo habitual
        set_time_limit(180);

        $empleados = DB::select("select AutoNum, IdPersona, IdEmpleado, Numero, Nombre, IdPuesto, Puesto, borrado, IdArea, Area, IdHorario, Horario
        from RH.fntjPersonal_Listado()
        where IdPersona not in (13757) and borrado = 0 order by Numero");

        $listadoIdPersona = "";

        foreach($empleados as $empleado){
            $listadoIdPersona = $listadoIdPersona. $empleado->IdPersona. ",";
        }

        //Eliminamos la ultima coma de la cadena
        $listadoIdPersona = substr($listadoIdPersona, 0, strlen($listadoIdPersona) - 1);



        $lista = DB::select("exec RH.pajRPTIncidencias_Seleccion @fechaInicio='$fechaInicio', @fechaFin='$fechaFin', @listado='$listadoIdPersona'");

        $conteos = DB::select("exec RH.pajRPTIncidenciasTotales_Seleccion @fechaInicio='$fechaInicio',@fechaFin='$fechaFin',
        @listado='$listadoIdPersona'");

        // Se cambia el formato de la fecha a formato de texto
        $tamañoLista = count($lista);
        for($i = 0; $i < $tamañoLista; $i++){

        setlocale(LC_TIME, 'es_ES');

        $fecha = $lista[$i]->Fecha;

        // Crear una instancia de Carbon a partir de la fecha
        $carbonFecha = Carbon::createFromFormat('Y-m-d', $fecha)->locale('es_ES');

        // Obtener el nombre del día de la semana y el día del mes
        $nombreDiaSemana = $carbonFecha->isoFormat('dddd');
        $diaMes = $carbonFecha->format('j');

        // Obtener el nombre del mes
        $nombreMes = $carbonFecha->isoFormat('MMMM');

        // Concatenar la información en el formato deseado
        $fechaFormateada = $nombreDiaSemana . ', ' . $diaMes . ' de ' . $nombreMes . ' de ' . $carbonFecha->year;

        // Imprimir la fecha formateada
        $lista[$i]->Fecha = $fechaFormateada;
        }


        // Se encarga de generar una variable con los empleados sin repetición
        $idempleados = [];
        $tamañoLista = count($lista);
        for($i = 0; $i < $tamañoLista; $i++){

            $empleado1 = new stdClass();
            $empleado1->idempleado = $lista[$i]->IdEmpleado;
            $empleado1->Nombre = $lista[$i]->Nombre;
            $empleado1->Numero = $lista[$i]->Numero;
            $e[] = $empleado1;
        }

        $empleadosSinRepetir = array();

        foreach ($e as $em) {
            $idempleado = $em->idempleado;
            if (!isset($empleadosSinRepetir[$idempleado])) {
                $empleadosSinRepetir[$idempleado] = $em;
            }
        }


        //Manda a llamar la propiedad o libreria dompdf
        $dompdf = App::make("dompdf.wrapper");

        //Manda las variables a la vista
        $dompdf->loadView('RecursosHumanos.Reportes.Incidencias.Seleccion.incidenciaSeleccionTodospdf', compact('fechaInicio', 'fechaFin', 'empleados', 'lista', 'empleadosSinRepetir', 'conteos'));

        //Tipo de papel, en este caso tamaño oficio
        $dompdf->setPaper('letter');

        //Retorna a la vista en formato pdf
        return $dompdf->stream('Incidencias '.$fechaInicio.' - '.$fechaFin.' .pdf');


    }


}
