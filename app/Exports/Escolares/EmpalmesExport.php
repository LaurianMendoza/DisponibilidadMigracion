<?php
namespace App\Exports\Escolares;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use stdClass;

class EmpalmesExport implements FromView
{
    public function view(): View{

        $empalmesDataset = DB::select("SELECT t3.idalumno,
        (SELECT persona.Fenombre(t3.idalumno, 1))Alumno, (SELECT a.matricula FROM escolares.alumno a WHERE a.idalumno = t3.idalumno) Matricula,
        t3.materia1, (SELECT c.nombre FROM escolares.alumnocarreras ac
        JOIN escolares.plan_estudios pe ON pe.idplan_estudios = ac.idplanestudios
        JOIN escolares.carrera c ON c.idcarrera = pe.idcarrera
        WHERE  ac.idalumno = t3.idalumno AND ac.estatus = 12) AS Carrera
        FROM (SELECT t1.idalumno, (SELECT m.nombre FROM escolares.materia m WHERE  m.idmateria = t1.idmateria)Materia1,
        (SELECT m.nombre FROM escolares.materia m WHERE  m.idmateria = t2.idmateria)Materia2
        FROM (SELECT g.idmateria, h.idgrupo, ga.idalumno, h.idaula, h.inicio, h.fin, h.dia
        FROM escolares.horario h
        JOIN escolares.grupo g ON g.idgrupo = h.idgrupo AND g.idcuatrimestre = (select subC.idcuatrimestre from Escolares.cuatrimestre subC where subC.estatus = 46) AND g.activo = 1
        JOIN escolares.grupo_alumno ga ON ga.idgrupo = g.idgrupo AND ga.baja = 0)t1
        JOIN (SELECT g2.idmateria, h2.idgrupo, ga2.idalumno, h2.idaula, h2.inicio,
        h2.fin, h2.dia FROM escolares.horario h2
        JOIN escolares.grupo g2 ON g2.idgrupo = h2.idgrupo AND g2.idcuatrimestre = (select subC.idcuatrimestre from Escolares.cuatrimestre subC where subC.estatus = 46) AND g2.activo = 1
        JOIN escolares.grupo_alumno ga2
        ON ga2.idgrupo = g2.idgrupo AND ga2.baja = 0)t2 ON t1.idalumno = t2.idalumno AND t1.idmateria <> t2.idmateria
        AND t1.dia = t2.dia AND ( t1.inicio = t2.inicio OR ( t1.inicio >= t2.inicio AND t1.inicio <= t2.fin)))t3
        GROUP  BY t3.idalumno, t3.materia1 ORDER BY t3.idalumno SELECT t3.idalumno, (SELECT persona.Fenombre(t3.idalumno, 1))Alumno,
        (SELECT a.matricula FROM escolares.alumno a
        WHERE a.idalumno = t3.idalumno) Matricula, t3.materia1,
        (SELECT c.nombre FROM escolares.alumnocarreras ac
        JOIN escolares.plan_estudios pe ON pe.idplan_estudios = ac.idplanestudios
        JOIN escolares.carrera c ON c.idcarrera = pe.idcarrera
        WHERE  ac.idalumno = t3.idalumno AND ac.estatus = 12) AS Carrera
        FROM  (SELECT t1.idalumno , (SELECT m.nombre FROM escolares.materia m WHERE  m.idmateria = t1.idmateria)Materia1,
        (SELECT m.nombre FROM escolares.materia m WHERE  m.idmateria = t2.idmateria)Materia2
        FROM (SELECT g.idmateria, h.idgrupo, ga.idalumno, h.idaula, h.inicio, h.fin, h.dia
        FROM escolares.horario h
        JOIN escolares.grupo g ON g.idgrupo = h.idgrupo AND g.idcuatrimestre =
        (select subC.idcuatrimestre from Escolares.cuatrimestre subC where subC.estatus = 46) AND g.activo = 1
        JOIN escolares.grupo_alumno ga ON ga.idgrupo = g.idgrupo AND ga.baja = 0)t1
        JOIN (SELECT g2.idmateria, h2.idgrupo, ga2.idalumno, h2.idaula, h2.inicio, h2.fin, h2.dia
        FROM escolares.horario h2 JOIN escolares.grupo g2 ON g2.idgrupo = h2.idgrupo AND g2.idcuatrimestre = (select subC.idcuatrimestre from Escolares.cuatrimestre subC where subC.estatus = 46) AND g2.activo = 1
        JOIN escolares.grupo_alumno ga2 ON ga2.idgrupo = g2.idgrupo AND ga2.baja = 0)t2 ON t1.idalumno = t2.idalumno
        AND t1.idmateria <> t2.idmateria AND t1.dia = t2.dia AND ( t1.inicio = t2.inicio OR ( t1.inicio >= t2.inicio AND t1.inicio <= t2.fin)))t3
        GROUP BY t3.idalumno, t3.materia1 ORDER BY t3.idalumno");

        return view('ServiciosEscolares.Informes.Empalmes.Excel.Empalmes',compact('empalmesDataset'));
    }

}
