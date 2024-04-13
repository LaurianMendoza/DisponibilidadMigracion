<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DisponibilidadController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisponibilidadController extends Controller
{
    //

    public function index()
    {
        //$horas=[];
        //$horas=DB::select('SELECT * FROM Escolares.cathoras;');
        
            $cuatrimestre = DB::select('SELECT * FROM Escolares.cuatrimestre WHERE estatus=46;');
            $empleado = DB::select("SELECT * FROM RH.empleado WHERE idpersona=" . session('idPersona'));
        
            $disponibilidad = [];
            for ($day = 1; $day <= 6; $day++) {
                for ($hour = 1; $hour <= 14; $hour++) {
                    $disponibilidad[$day][$hour] = DB::table('Escolares.Disponibilidad')
                        ->where('idempleado', $empleado[0]->idempleado)
                        ->where('idcathoras', $hour)
                        ->where('iddias', $day)
                        ->where('idcuatrimestre', $cuatrimestre[0]->idcuatrimestre)
                        ->exists();
                }
            }


            $enviado = DB::table('Escolares.Estatusdisp')
            ->where('idempleado', $empleado[0]->idempleado)
            ->where('idcuatrimestre', $cuatrimestre[0]->idcuatrimestre)
            ->exists();

        
            return view('Docentes.disponibilidad', compact('disponibilidad','enviado'));
        }



    public function update(Request $request)
    {
         $cuatrimestre=[];
         $cuatrimestre=DB::select('SELECT * FROM Escolares.cuatrimestre where estatus=46;');
        
      
         $empleado=[];
         $empleado=DB::select("SELECT * FROM RH.empleado where idpersona=". session('idPersona')."");



         $day = $request->input('day');
         $hour = $request->input('hour');
     
         $disponibilidad = DB::table('Escolares.Disponibilidad')
             ->where('idempleado', $empleado[0]->idempleado)
             ->where('idcathoras', $hour)
             ->where('iddias', $day)
             ->where('idcuatrimestre', $cuatrimestre[0]->idcuatrimestre)
             ->first();
     
             if ($disponibilidad) {
                // Si ya existe un registro, lo eliminamos
                DB::table('Escolares.Disponibilidad')
                    ->where('iddisponibilidad', $disponibilidad->iddisponibilidad) 
                    ->delete();
                session()->put('disponibilidad_' . $day . '_' . $hour, false); // Marcar como no disponible en la sesión
            } else {
             // Si no existe un registro, lo creamos
             DB::table('Escolares.Disponibilidad')->insert([
                 'idempleado' => $empleado[0]->idempleado,
                 'idcathoras' => $hour,
                 'iddias' => $day,
                 'idcuatrimestre' => $cuatrimestre[0]->idcuatrimestre
             ]);
             session()->put('disponibilidad_' . $day . '_' . $hour, true); // Marcar como disponible en la sesión
         }


         // Actualizar estatus del docente si todos los botones "Enviar" han sido presionados
         $estatus_disp = DB::table('Escolares.Disponibilidad')
             ->where('idempleado', $empleado[0]->idempleado)
             ->where('idcuatrimestre', $cuatrimestre[0]->idcuatrimestre)
             ->count();

         if ($estatus_disp == 84) { // Total de botones en la tabla
             DB::table('Escolares.Estatusdisp')
                 ->insert([
                     'idempleado' => $empleado[0]->idempleado,
                     'status' => 1,
                     'idcuatrimestre' => $cuatrimestre[0]->idcuatrimestre
                 ]);
         }

         
     
         return redirect()->route('docentes.indexDisponibilidad');
     }






    public function enviarEstatus(Request $request)
    {
        
        $cuatrimestre = DB::select('SELECT * FROM Escolares.cuatrimestre WHERE estatus=46;');
        $empleado = DB::select("SELECT * FROM RH.empleado WHERE idpersona=" . session('idPersona'));

        DB::table('Escolares.Estatusdisp')
            ->insert([
                'idempleado' => $empleado[0]->idempleado,
                'estatus' => 1,
                'idcuatrimestre' => $cuatrimestre[0]->idcuatrimestre
            ]);

        return redirect()->route('docentes.indexDisponibilidad');
    }


}
