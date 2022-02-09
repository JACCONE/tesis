<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\tareas;

class tareasController extends Controller
{
    //
    public function update_tareas(Request $request){
        
        $tarea = tareas:: find($request->get('id'));
        if ($tarea == null) {
            $tarea = new tareas();
        }
        $tarea->id_docente = $request->get('id_docente');
        $tarea->id_periodo = $request->get('id_periodo');
        $tarea->id_asignatura = $request->get('id_asignatura');
        $tarea->paralelo = $request->get('paralelo');
        $tarea->id_rubrica = $request->get('id_rubrica');
        $tarea->nombre = $request->get('nombre');
        $tarea->descripcion = $request->get('descripcion');
        $tarea->nota_maxima = $request->get('nota_maxima');
        $tarea->fecha_inicio = $request->get('fecha_inicio');
        $tarea->fecha_fin = $request->get('fecha_fin');
        $tarea->link = $request->get('link');
        $tarea->estado = $request->get('estado');

        $tarea->save();

        return response()->json($tarea);  
    }
    public function get_tareas($id_docente){
        $info = DB::connection('pgsql')->select(
            "SELECT tar.estado as estado,concat(fecha_inicio,' - ', fecha_fin) as fecha, tar.id as id_tarea
            , mat.nombre as materia,  tar.nombre as nombre, par.nombre as paralelo, tar.descripcion
            ,tar.nota_maxima,tar.fecha_inicio, tar.fecha_fin, tar.link, rub.nombre as rubrica, tar.id_asignatura as id_asi
            ,tar.paralelo as id_paralelo, rub.id as id_rubrica
            from tesis.tareas_envio tar
            inner join esq_mallas.materia mat
            on mat.idmateria = tar.id_asignatura
            inner join esq_distributivos.paralelo par
            on par.idparalelo = tar.paralelo
            inner join tesis.rubricas rub
            on rub.id = tar.id_rubrica
            where tar.id_docente = $id_docente
            group by tar.estado,fecha,id_tarea
            ,materia,tar.nombre,par.nombre, tar.descripcion
            ,tar.nota_maxima,tar.fecha_inicio, tar.fecha_fin, tar.link,rubrica,tar.id_asignatura,
            tar.paralelo,rub.id
            order by fecha_inicio desc"
            );
            return response()->json($info);
    }
    public function get_estudiantes_paralelo(Request $request){
        $periodo = $request->get('id_periodo');
        $docente = $request->get('id_docente');
        $materia = $request->get('id_materia');
        $paralelo = $request->get('id_paralelo');
        $distributivo = DB::connection('pgsql')->select("SELECT 
        pe.idpersonal
        ,pe.nombres || ' ' || pe.apellido1 || '' || pe.apellido2 AS estudiante
        ,pe.correo_personal_institucional as correo
        FROM esq_inscripciones.inscripcion_detalle det
        inner join esq_datos_personales.personal pe
        on pe.idpersonal = det.idpersonal
        where idperiodo = $periodo
        and det.iddistributivo in(SELECT
            da.iddistributivo AS distributivo
            FROM esq_inscripciones.inscripcion_detalle id
            JOIN esq_distributivos.distribucion_academica da 
                ON id.iddistributivo = da.iddistributivo 
                AND id.idperiodo = $periodo
                AND da.idpersonal = $docente
                AND id.idmateria = $materia
                AND da.idparalelo = $paralelo
            GROUP BY da.iddistributivo)
        group by estudiante, correo, pe.idpersonal");
        return response()->json($distributivo);
        /* */
    }
    public function get_tareas_estudiantes(Request $request){
        $periodo = $request->get('periodo');
        $estudiante = $request->get('estudiante');
        /*
        $materias = DB::connection('pgsql')->select("SELECT  idmateria
        FROM esq_inscripciones.inscripcion_detalle where idpersonal = $estudiante
        and idperiodo = $periodo");*/
        $tareas = DB::connection('pgsql')->select("SELECT tar.id, tar.id_periodo, tar.id_asignatura,
        mat.nombre as materia, tar.paralelo, tar.id_rubrica, 
        tar.nombre, tar.descripcion, tar.nota_maxima, 
        tar.fecha_inicio, tar.fecha_fin, tar.link, tar.estado, tar.id_docente
        FROM tesis.tareas_envio tar
        inner join esq_mallas.materia mat
        on mat.idmateria = tar.id_asignatura
        where  id_periodo = $periodo
        and id_asignatura in (SELECT  idmateria
        FROM esq_inscripciones.inscripcion_detalle 
        where idpersonal = $estudiante
        and idperiodo = $periodo)
        ");
        return response()->json($tareas);
    }
}
