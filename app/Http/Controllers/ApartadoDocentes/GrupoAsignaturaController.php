<?php

namespace App\Http\Controllers\ApartadoDocentes;

use App\Exports\Docentes\listaAsistenciaExports;
use App\Exports\Docentes\PlantillaExcelCalificaciones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TokensGenerator;
use App\Imports\CalificacionesImport;
use App\Mail\Docentes\GrupoAsignatura;
use App\Models\Alumno;
use App\Models\Cuatrimestre;
use App\Models\Empleado;
use App\Models\GrupoAlumnoCalificaciones;
use App\Models\Grupos;
use App\Models\GruposAlumno;
use App\Models\Materia;
use App\Models\PlanEstudiosMaterias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Svg\Tag\Rect;

use function PHPUnit\Framework\isNull;

class GrupoAsignaturaController extends Controller
{
    public function index()
    {
        session(["tab_horario" => true]);
        session(["tab_alumnos_reprobados" => false]);

        $profesor = [];
        $profesor = Empleado::where('idpersona', session("idPersona"))->get();

        $grupos = DB::select("exec sp_executesql N'Select g.idgrupo, g.clave, (SELECT escolares.feObtenerNombreMateria(0,
        g.idMateria))Materia FROM escolares.grupo g
        WHERE g.idcuatrimestre = (select idcuatrimestre from Escolares.cuatrimestre where estatus = 46) AND g.idempleado = @idProfesor AND g.activo = 1',
        N'@idProfesor int',@idProfesor=" . $profesor[0]->idempleado);

        return view('Docentes.GrupoAsignatura.gruposAsignaturas', compact('grupos'));
    }



}
