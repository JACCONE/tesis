<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
//use app\Models\tareas;
class tareasController extends Controller
{
    //
    public function update_tareas(Request $request){
        $id_tarea = $request->get('id_tarea');
        $id_periodo = $request->get('id_periodo');
        $id_asignatura= $request->get('id_asignatura');
        $paralelo = $request->get('paralelo');
        $id_rubrica = $request->get('id_rubrica');
        $nombre = $request->get('nombre');
        $descripcion= $request->get('descripcion');
        $nota= $request->get('nota_maxima');
        $f_inicio = $request->get('fecha_inicio');
        $f_final = $request->get('fecha_fin');
        $link = $request->get('link');
        $estado = $request->get('estado');
        $docente = $request->get('id_docente');
        $validar = DB::connection('pgsql')->select("SELECT count(*)as total 
         FROM tesis.tareas_envio
         where id = $id_tarea
        and estado= 'EN DESARROLLO'");
        $existe = $validar[0]->total;
        if($existe == 0){
            $insertar = DB::connection('pgsql')->insert("INSERT INTO tesis.tareas_envio(
                id_periodo, id_asignatura, paralelo, id_rubrica, nombre, descripcion, nota_maxima, fecha_inicio, fecha_fin, link, estado, id_docente)
                VALUES ($id_periodo
                , $id_asignatura
                , $paralelo
                , $id_rubrica
                , '$nombre'
                , '$descripcion'
                , $nota
                , '$f_inicio'
                , '$f_final'
                , '$link'
                , '$estado'
                , $docente)");
        }else{
            $insertar = DB::connection('pgsql')->update("UPDATE tesis.tareas_envio
            SET id_periodo=$id_periodo
            , id_asignatura=$id_asignatura
            , paralelo=$paralelo
            , id_rubrica=$id_rubrica
            , nombre= '$nombre'
            , descripcion='$descripcion'
            , nota_maxima=$nota
            , fecha_inicio='$f_inicio'
            , fecha_fin='$f_final'
            , link= '$link'
            , estado='$estado'
            , id_docente=$docente
            WHERE id= $id_tarea" );
        }
        return response()->json($insertar);
        /*
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

        return response()->json($tarea);  */
    }
    public function get_tareas($id_docente){
        $info = DB::connection('pgsql')->select(
            "SELECT tar.estado as estado,concat(fecha_inicio,' - ', fecha_fin) as fecha, tar.id as id_tarea
            , mat.nombre as materia,  tar.nombre as nombre, par.nombre as paralelo, tar.descripcion
            ,tar.nota_maxima,tar.fecha_inicio, tar.fecha_fin, tar.link, rub.nombre as rubrica, tar.id_asignatura as id_asi
            ,tar.paralelo as id_paralelo, rub.id as id_rubrica
            ,CASE WHEN con.id is null THEN 0
			ELSE 1
			END as evaluacion_pares
            from tesis.tareas_envio tar
            inner join esq_mallas.materia mat
            on mat.idmateria = tar.id_asignatura
            inner join esq_distributivos.paralelo par
            on par.idparalelo = tar.paralelo
            inner join tesis.rubricas rub
            on rub.id = tar.id_rubrica
            left join tesis.asignacion_control con
			on con.id_tarea = tar.id
            where tar.id_docente = $id_docente
            group by tar.estado,fecha,id_tarea
            ,materia,tar.nombre,par.nombre, tar.descripcion
            ,tar.nota_maxima,tar.fecha_inicio, tar.fecha_fin, tar.link,rubrica,tar.id_asignatura,
            tar.paralelo,rub.id, tar.id, con.id
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
            id_estudiante, id_tarea, link_drive, fecha_envio,calificado)
            VALUES ($estudiante, $tarea, '$link', NOW(), 0)");
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
                id_asignacion, id_estudiante, id_asignado, estado)
                VALUES ($id_a,$id_e, $id_o, 1)");
        }
        return 'ok';        
    }
    public function get_asignaciones_general($id_t){
        $id_ta = $id_t;
        $asignacion = DB::connection('pgsql')->select("SELECT distinct
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
		,pe2.nombres || ' ' || pe2.apellido1 || ' ' || pe2.apellido2 AS n_asignado
        ,pe.correo_personal_institucional as correo
        ,eje.fecha_envio
        ,eje.link_drive as link_envio
        FROM tesis.asignacion_estudiante est
        inner join  esq_datos_personales.personal pe
        on pe.idpersonal = est.id_estudiante
		inner join esq_datos_personales.personal pe2
		on pe2.idpersonal = est.id_asignado
        inner join tesis.tareas_ejecucion eje
        on eje.id_estudiante = est.id_estudiante
        inner join tesis.asignacion_control con
        on con.id_tarea = eje.id_tarea
        and con.id = est.id_asignacion
        where con.id_tarea = $id_t
        group by est.id, estudiante,n_asignado,asignado,correo,eje.fecha_envio,link_envio
        ");
        return response()->json($asignaciones); 
    }
    public function get_asignaciones_docente($id_docente){
        $id_d = $id_docente;
        $asignaciones = DB::connection('pgsql')->select("SELECT 
        env.nombre as nombre_tarea
        ,env.descripcion as d_tarea
        ,mat.nombre as nombre_mat
        ,pe.nombres || ' ' || pe.apellido1 || ' ' || pe.apellido2 AS docente
        ,pe2.nombres || ' ' || pe2.apellido1 || ' ' || pe2.apellido2 AS asignado
        , env.id_rubrica 
        , eje.link_drive
        , eje.calificado as estado
        , env.fecha_fin
        , eje.id_estudiante
        , eje.id_tarea
        FROM tesis.tareas_ejecucion eje
        inner join tesis.tareas_envio env
        on env.id = eje.id_tarea
        inner join esq_mallas.materia mat
        on mat.idmateria = env.id_asignatura
        inner join esq_datos_personales.personal pe
        on pe.idpersonal = env.id_docente
        inner join esq_datos_personales.personal pe2
        on pe2.idpersonal = eje.id_estudiante
        where env.id_docente = $id_d
        and fecha_fin < NOW()
        and calificado = 'EN PROCESO'
        group by  nombre_tarea,d_tarea,nombre_mat,docente,asignado, env.id_rubrica 
        , eje.link_drive, eje.calificado, env.fecha_fin, eje.id_estudiante, eje.id_tarea
        ");
        return response()->json($asignaciones); 
    }
    
    public function get_asignaciones_estudiantes($id_estudiante){
        $asignaciones_e = DB::connection('pgsql')->select("SELECT 
        tar.nombre as nombre_tarea
        ,tar.descripcion as d_tarea
        ,mat.nombre as nombre_mat
        ,pe.nombres || ' ' || pe.apellido1 || ' ' || pe.apellido2 AS docente
        ,pe2.nombres || ' ' || pe2.apellido1 || ' ' || pe2.apellido2 AS asignado
        , est.id_asignado
        , tar.id_rubrica 
        , eje.link_drive
        , est.estado
        , con.fecha_final
		, est.id as id_asignacion_estudiante
            FROM tesis.asignacion_estudiante est
            inner join tesis.asignacion_control con
            on con.id = est.id_asignacion
            inner join tesis.tareas_envio tar
            on tar.id = con.id_tarea
            inner join tesis.tareas_ejecucion eje
            on eje.id_tarea = tar.id
            and eje.id_estudiante = est.id_asignado
            inner join esq_mallas.materia mat
            on mat.idmateria = tar.id_asignatura
            inner join esq_datos_personales.personal pe
            on pe.idpersonal = tar.id_docente
            inner join esq_datos_personales.personal pe2
            on pe2.idpersonal = est.id_asignado
            where est.id_estudiante = $id_estudiante
            and est.estado = 1
            and con.fecha_final > NOW()
            group by nombre_tarea, d_tarea, nombre_mat, docente, asignado, id_asignado, id_rubrica
            ,link_drive, est.estado, con.fecha_final, est.id");
            return response()->json($asignaciones_e); 
    }
    public function guardar_evaluacion_pares(Request $request){
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $eval){
            $id_asignacion = $eval['id_asignacion_estudiante'];
            $id_criterio = $eval['id_criterio'];
            $id_nivel = $eval['id_nivel'];
            $observa = $eval['observacion'];
            $evaluacion = DB:: connection('pgsql')->insert("INSERT INTO tesis.evaluacion_pares(
                id_asignacion_estudiante, id_criterio, id_nivel, fecha_evaluacion,observacion)
                VALUES ($id_asignacion, $id_criterio, $id_nivel, NOW(),'$observa')");
        }
        $estado_act = DB::connection('pgsql')->update("UPDATE tesis.asignacion_estudiante
        SET  estado=2
        WHERE id = $id_asignacion");
        return $estado_act;   
    }
    public function guardar_evaluacion_docente(Request $request){
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $eval){
            $id_tarea = $eval['id_tarea'];
            $id_estudiante = $eval['id_estudiante'];
            $id_criterio = $eval['id_criterio'];
            $id_nivel = $eval['id_nivel'];
            $observa = $eval['observacion'];
            $evaluacion = DB:: connection('pgsql')->insert("INSERT INTO tesis.evaluacion_pares_docente(
               id_tarea, id_estudiante, id_criterio, id_nivel, fecha_evaluacion,observacion)
                VALUES ($id_tarea,$id_estudiante, $id_criterio, $id_nivel, NOW(),'$observa')");
        
        }
        $estado_act = DB::connection('pgsql')->update("UPDATE tesis.tareas_ejecucion
            SET  calificado = 'CALIFICADO'
            WHERE id_estudiante = $id_estudiante
            and id_tarea = $id_tarea");
        return $estado_act;   
    }
    public function get_satisfaccion_question($tipo)
    {
        $tip = $tipo;
            $consulta = DB::connection('pgsql')->select("SELECT id, pregunta, tipo
                FROM tesis.preguntas_cuestionarios
                where tipo = $tip
            ");
            return response()->json($consulta); 
    }
    public function save_cuestionario(Request $request){
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $eval){
            $id_rubrica = $eval['id_rubrica'];
            $id_estudiante = $eval['id_estudiante'];
            $id_pregunta = $eval['id_pregunta'];
            $calificacion = $eval['calificacion'];
            $almacenar = DB::connection('pgsql')->insert("INSERT INTO tesis.satisfaccion_validez(
                id_rubrica, id_estudiante, id_pregunta, calificacion, fecha_cuestionario)
                VALUES ( $id_rubrica, $id_estudiante, $id_pregunta, $calificacion, NOW())");
        }
        return $almacenar;
    }
    public function control_cuestionario($rurbica, $estudiante){
        $control = DB:: connection('pgsql')->select("SELECT count(*)as total FROM tesis.satisfaccion_validez
        where id_rubrica= $rurbica
        and id_estudiante = $estudiante");

        return $control[0]->total;

    }
    public function get_notas_docente($id_tarea){
        // obtener nota maxima sobre la que se califica la tarea
        $nota = DB::connection('pgsql')->select("SELECT nota_maxima as nota_max 
        FROM tesis.tareas_envio
        where id = $id_tarea");

        //obtener nivel maximo de la rubrica para la tarea
        $nivel = DB::connection('pgsql')->select("SELECT max(niv.valoracion)as nivel_max FROM tesis.tareas_envio env
        inner join tesis.evaluacion_pares_docente eva
        on eva.id_tarea = env.id
        inner join tesis.rubrica_niveles niv
        on niv.id_rubrica = env.id_rubrica
        where env.id = $id_tarea");

        //obtener estudiantes que enviaron la tarea y estan evaluados por docente
        $estudiantes = DB::connection('pgsql')->select("SELECT id_estudiante
        FROM tesis.evaluacion_pares_docente 
        where id_tarea = $id_tarea
		group by id_estudiante");       

        //obtener las valoraciones por criterios
        $cal_criterio = DB::connection('pgsql')->select("SELECT eva.id_estudiante, niv.valoracion, cri.porcentaje
        FROM tesis.evaluacion_pares_docente eva
        inner join tesis.rubrica_niveles niv
        on niv.id = eva.id_nivel
        inner join tesis.rubrica_criterios cri
        on cri.id = eva.id_criterio
        where eva.id_tarea = $id_tarea");

        $por_acu_total = [];
        //$temp = [];
        foreach($estudiantes as $estu){
          
            $por_acu = 0;
            foreach($cal_criterio as $cri_not){
                $porcentaje = $cri_not->porcentaje;
                $valoracion = $cri_not->valoracion;
                
                if($estu->id_estudiante == $cri_not->id_estudiante){
                    $por_acu = $por_acu + ($porcentaje*$valoracion/$nivel[0]->nivel_max);
                }
            };
            $nota_f = ($nota[0]->nota_max * $por_acu)/100;
            $añadir = [
                $estu->id_estudiante,
                $nota_f
            ];
            array_push($por_acu_total, $añadir);
            
        } 

        //para notas dadas por estudiantes
        $cal_estudiantes = DB:: connection('pgsql')->select("SELECT eva.id_asignacion_estudiante,asig.id_estudiante,asig.id_asignado, niv.valoracion, cri.porcentaje
        FROM tesis.evaluacion_pares eva
		inner join tesis.asignacion_estudiante asig
		on asig.id = eva.id_asignacion_estudiante
		inner join tesis.asignacion_control con
		on con.id = asig.id_asignacion
        inner join tesis.rubrica_niveles niv
        on niv.id = eva.id_nivel
        inner join tesis.rubrica_criterios cri
        on cri.id = eva.id_criterio
        where con.id_tarea = $id_tarea");

        //estudiantes que han evaluado
        $estudiantes_e = DB::connection('pgsql')->select("SELECT eva.id_asignacion_estudiante
        FROM tesis.evaluacion_pares eva
		inner join tesis.asignacion_estudiante asig
		on asig.id = eva.id_asignacion_estudiante
		inner join tesis.asignacion_control con
		on con.id = asig.id_asignacion
        where con.id_tarea = $id_tarea
		group by eva.id_asignacion_estudiante");

        $por_acu_total_e = [];
        foreach($estudiantes_e as $estu_e){
                
            $por_acu2 = 0;
            $id_e = 0;
            $id_a = 0;
            foreach($cal_estudiantes as $cal_not){
                $porcentaje_e = $cal_not->porcentaje;
                $valoracion_e = $cal_not->valoracion;
                
                if($estu_e->id_asignacion_estudiante == $cal_not->id_asignacion_estudiante){
                    $por_acu2 = $por_acu2 + ($porcentaje_e*$valoracion_e/$nivel[0]->nivel_max);
                    $id_e = $cal_not->id_estudiante;
                    $id_a = $cal_not->id_asignado;
                }
            };
            $nota_f_e = ($nota[0]->nota_max * $por_acu2)/100;
            $añadir2 = [
                $id_e,
                $id_a,
                $nota_f_e
            ];
            array_push($por_acu_total_e, $añadir2);
            
        } 

        //
        return response()->json([
             //$cal_criterio,
             //$estudiantes_e,
             //$cal_estudiantes,
             $por_acu_total,
             $por_acu_total_e
        ], 200);


    }
}
