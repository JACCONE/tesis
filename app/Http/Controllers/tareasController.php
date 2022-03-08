<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use app\Models\tareas;
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
        $id_tarea = $request->get('id_tarea');
        $distributivo = DB::connection('pgsql')->select("SELECT 
        pe.idpersonal
        ,pe.nombres || ' ' || pe.apellido1 || ' ' || pe.apellido2 AS estudiante
        ,pe.correo_personal_institucional as correo
        ,CASE
           WHEN eje.link_drive isnull
                THEN ''
           else
                eje.link_drive 
        END link_envio
		,CASE
           WHEN eje.link_drive  IS NOT NULL
                THEN
                eje.fecha_envio 
        END fecha_envio
		,CASE
           WHEN eje.link_drive isnull
                THEN 'PENDIENTE'
           else
                'ENVIADA'
        END estado
        FROM esq_inscripciones.inscripcion_detalle det
        inner join esq_datos_personales.personal pe
        on pe.idpersonal = det.idpersonal
        left join tesis.tareas_ejecucion eje
		on eje.id_estudiante = pe.idpersonal
        and eje.id_tarea = $id_tarea
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
            group by estudiante, correo, pe.idpersonal, eje.link_drive, fecha_envio");
        return response()->json($distributivo);
        /* */
    }
    public function get_tareas_estudiantes(Request $request){
        $periodo = $request->get('periodo');
        $asignatura = $request->get('asignatura');
        $estudiante = $request->get('estudiante');
        $tareas = DB::connection('pgsql')->select("SELECT tar.id, tar.id_periodo, tar.id_asignatura,
        mat.nombre as materia, tar.paralelo, tar.id_rubrica, 
        tar.nombre, tar.descripcion, tar.nota_maxima, 
        tar.fecha_inicio, tar.fecha_fin, tar.link, tar.estado, tar.id_docente,
        CASE
           WHEN tar.fecha_fin < NOW()
                THEN 'EXPIRADA'
           WHEN tar.fecha_fin > NOW()
               THEN 'ACTIVA'
        END estado,
        CASE
           WHEN eje.link_drive isnull
                THEN ''
           else
                eje.link_drive 
        END link_envio
        FROM tesis.tareas_envio tar
        left join tesis.tareas_ejecucion eje
		on eje.id_tarea = tar.id
        
        and eje.id_estudiante = $estudiante
        inner join esq_mallas.materia mat
        on mat.idmateria = tar.id_asignatura
        where  id_periodo = $periodo
        and id_asignatura = $asignatura
        ");
        return response()->json($tareas);
    }
    public function get_materias_estudiante(Request $request){
        $periodo = $request->get('periodo');
        $estudiante = $request->get('estudiante');
        $materias_estudiante = DB::connection('pgsql')->select("SELECT mate.id_asignatura, mate.nombre, count(env.id_asignatura)as tareas FROM(
            SELECT mat.idmateria as id_asignatura, mat.nombre as nombre FROM esq_mallas.materia mat
            inner join esq_inscripciones.inscripcion_detalle  ins
            on ins.idmateria = mat.idmateria
            where ins.idpersonal = $estudiante
            and ins.idperiodo = $periodo
            )as mate
            left join tesis.tareas_envio env
            on mate.id_asignatura = env.id_asignatura
            group by mate.id_asignatura,mate.nombre;
        ");
        return response()->json($materias_estudiante);
    }
    public function actualizar_tarea_envio(Request $request){
        $estudiante = $request->get('estudiante');
        $tarea = $request->get('tarea');
        $link = $request->get('link');
        $validar = DB::connection('pgsql')->select("SELECT count(*) as total
        FROM tesis.tareas_ejecucion
        where id_estudiante = $estudiante
        and id_tarea = $tarea");
        $existe = $validar[0]->total;
        if($existe == 0){
            $insertar = DB::connection('pgsql')->insert("INSERT INTO tesis.tareas_ejecucion(
            id_estudiante, id_tarea, link_drive, fecha_envio)
            VALUES ($estudiante, $tarea, '$link', NOW())");
        }else{
            $actualizar = DB::connection('pgsql')->update("UPDATE tesis.tareas_ejecucion
            set link_drive='$link', 
            fecha_envio= NOW()
            where id_estudiante = $estudiante
            and id_tarea = $tarea");
        }
    }
    public function asignacion_estado(Request $request){
        $doc = $request->get('docente');
        $tar = $request->get('tarea');
        //
        $control = DB::connection('pgsql')->select("SELECT count(id)as tot
        FROM tesis.asignacion_control
        where id_docente = $doc
        and id_tarea = $tar");
        return  $control[0]->tot;
    }
    public function act_tareas_control(Request $request){
        $doce = $request->get('docente');
        $tare = $request->get('tarea');
        $fec = $request->get('fecha');
        $control = DB::connection('pgsql')->insert("INSERT INTO tesis.asignacion_control
        (id_docente, id_tarea, fecha_asignacion, fecha_final)
           VALUES ($doce,$tare, NOW(),'$fec')");

        $id_control = DB::connection('pgsql')->select("SELECT id as id_control
        FROM tesis.asignacion_control
        WHERE id_docente = $doce and id_tarea = $tare");

        return $id_control[0]->id_control;
    }

    public function act_asignacion_estudiante_general(Request $request){
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $asigna){
            $id_a = $asigna['id_asignacion'];
            $id_e = $asigna['id_estudiante'];
            $id_o = $asigna['id_asignado'];
            $asignacion = DB:: connection('pgsql')->insert("INSERT INTO tesis.asignacion_estudiante(
                id_asignacion, id_estudiante, id_asignado)
                VALUES ($id_a,$id_e, $id_o)");
        }
        return 'ok';        
    }
    public function get_asignaciones_general($id_t){
        $id_ta = $id_t;
        $asignacion = DB::connection('pgsql')->select("        SELECT distinct
        est.id_estudiante as idpersonal
        ,pe.nombres || ' ' || pe.apellido1 || ' ' || pe.apellido2 AS estudiante
        ,pe.correo_personal_institucional as correo
        ,eje.fecha_envio
        ,eje.link_drive as link_envio
        FROM tesis.asignacion_estudiante est
        inner join  esq_datos_personales.personal pe
        on pe.idpersonal = est.id_estudiante
        inner join tesis.tareas_ejecucion eje
        on eje.id_estudiante = est.id_estudiante
        inner join tesis.asignacion_control con
        on con.id_tarea = eje.id_tarea
        where con.id_tarea = $id_ta"); 
        
        return response()->json($asignacion); 

    }
    public function get_asignaciones($id_tarea){
        $id_t = $id_tarea;
        $asignaciones = DB::connection('pgsql')->select("SELECT 
        est.id_estudiante as idpersonal
        ,est.id_asignado as asignado
        ,pe.nombres || ' ' || pe.apellido1 || ' ' || pe.apellido2 AS estudiante
        ,pe.correo_personal_institucional as correo
        ,eje.fecha_envio
        ,eje.link_drive as link_envio
        FROM tesis.asignacion_estudiante est
        inner join  esq_datos_personales.personal pe
        on pe.idpersonal = est.id_estudiante
        inner join tesis.tareas_ejecucion eje
        on eje.id_estudiante = est.id_estudiante
        inner join tesis.asignacion_control con
        on con.id_tarea = eje.id_tarea
        where con.id_tarea = $id_t
        group by est.id, estudiante,asignado,correo,eje.fecha_envio,link_envio
        ");
        return response()->json($asignaciones); 
    }
}
