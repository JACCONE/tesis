<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class estadisticasController extends Controller
{
    //
    public function get_rub_evaluadas($id_docente){
        $info = DB::connection('pgsql')->select(
            " SELECT rub.id as id_rubrica, rub.nombre as nombre 
            from tesis.rubricas rub
          where 
           rub.id_docente = $id_docente
		   and rub.estado IN ('EN USO','EVALUADA')"
           /*  "SELECT rub.id as id_rubrica, rub.nombre as nombre from  tesis.evaluaciones eva
            inner join tesis.rubricas rub
            on rub.id = eva.id_rubrica
            where rub.id_docente = $id_docente
            and eva.estado = 'EN USO'
            group by rub.id,rub.nombre" */
            );
            return response()->json($info);
    }
    public function get_expertos_rubricas($id_rubrica){
        $expertos = DB::connection('pgsql')->select("SELECT expe.id as id_experto, concat(UPPER(expe.nombres),' ',UPPER(expe.apellidos))as nombres 
        FROM tesis.expertos expe
        inner join tesis.evaluaciones eva
        on eva.id_experto = expe.id
        where eva.id_rubrica = $id_rubrica");

        return response()->json($expertos);
    }

    public function get_crit_eval($id_rubrica)
    {
        $criterios = DB::connection('pgsql')->select("SELECT id as id_criterio, CONCAT(UPPER(LEFT(nombre, 1)), LOWER(SUBSTRING(nombre, 2)))as nombre from tesis.rubrica_criterios
        where id_rubrica = $id_rubrica order by id asc");

        return response()->json($criterios);
    }

    public function get_ite_eval($id_rubrica)
    {
        $items = DB::connection('pgsql')->select("SELECT ite.id as id_item, ite.id_criterio, CONCAT(UPPER(LEFT(ite.nombre, 1)), LOWER(SUBSTRING(ite.nombre, 2)))as nombre
        from tesis.criterios_items ite
        inner join tesis.rubrica_criterios cri
        on cri.id = ite.id_criterio 
        where cri.id_rubrica = $id_rubrica order by ite.id_criterio asc");

        return response()->json($items);
    }

    public function get_cal_suf($id_rubrica){
        $suf = DB::connection('pgsql')->select("SELECT expe.id as id_experto,ite.id_criterio as id_criterio,cal.suficiencia as suficiencia
        FROM tesis.evaluaciones_suficiencia cal
        inner join tesis.evaluaciones eva
        on eva.id = cal.id_evaluacion
        inner join tesis.expertos expe
        on expe.id = eva.id_experto
        inner join tesis.criterios_items ite
        on ite.id_criterio = cal.id_criterio
        where eva.estado = 'EVALUADO'
        and eva.id_rubrica = $id_rubrica
        group by expe.id,cal.id_criterio,ite.id_criterio,cal.suficiencia order by ite.id_criterio asc");

        return response()->json($suf);
    }

    public function get_eva_rub_gen($id_rubrica){
        $gen = DB::connection('pgsql')->select("SELECT eva.id_experto, cri.id as id_criterio, cal.id_item, cal.coherencia, cal.relevancia, cal.claridad, CASE WHEN trim(cal.observacion) = ''
        then 'Sin Observaciones' ELSE cal.observacion
        END
        FROM tesis.evaluaciones_calificaciones cal
        inner join tesis.evaluaciones eva
        on eva.id = cal.id_evaluacion
        inner join tesis.criterios_items ite
        on ite.id = cal.id_item
        inner join tesis.rubrica_criterios cri
        on cri.id = ite.id_criterio
        where eva.estado = 'EVALUADO'
        and eva.id_rubrica = $id_rubrica
        group by  eva.id_experto, cri.id, cal.id_item, cal.coherencia, cal.relevancia, cal.claridad, cal.observacion
        order by cri.id asc");

        return response()->json($gen);
    }
    public function get_obs_eva($id_rubrica){
        $obs = DB::connection('pgsql')->select("SELECT eva.id_experto, CASE WHEN trim(obs.observacion) = ''
        then 'Sin Observaciones' ELSE obs.observacion
        END
            FROM tesis.observacion_evaluacion obs
            inner join tesis.evaluaciones eva
            on eva.id = obs.id_evaluacion
            where obs.id_rubrica = $id_rubrica");

        return response()->json($obs);
    }

    public function get_control_eva($id_rubrica){
        $con = DB::connection('pgsql')->select("SELECT count(id)as existe from tesis.evaluaciones
        where id_rubrica = $id_rubrica
        and estado != 'EVALUADO'");

        return response()->json($con[0]->existe);
    }

    public function get_cuestionario_preguntas($id_rubrica){
        $pre = DB::connection('pgsql')->select("SELECT id, pregunta, tipo
        FROM tesis.preguntas_cuestionarios");

        return response()->json($pre);
    }

    public function get_total_estu($id_rubrica){
        $tot = DB::connection('pgsql')->select("SELECT count(distinct(id_estudiante))as total
        FROM tesis.satisfaccion_validez
        where id_rubrica = $id_rubrica");

        return response()->json($tot[0]->total);
    }
    public function get_cuestionario_calificaciones($id_rubrica){
        $cue = DB::connection('pgsql')->select("SELECT val.id_estudiante, val.id_pregunta, val.calificacion, cue.tipo
        from tesis.satisfaccion_validez val
	    inner join tesis.preguntas_cuestionarios cue
		on cue.id = val.id_pregunta 
        where val.id_rubrica = $id_rubrica
		order by cue.tipo asc");

        return response()->json($cue);
    }
    /*peticiones para alfa de cronbanch*/
    public function get_t_doc($id_docente,$id_rubrica){
        $tar = DB::connection('pgsql')->select("SELECT id, nombre
        FROM tesis.tareas_envio
        where id_docente = $id_docente
        and id_rubrica = $id_rubrica
        and fecha_fin < NOW()");

        return response()->json($tar);
    }

    public function get_c_doc($id_rubrica){
        $cal = DB::connection('pgsql')->select("SELECT env.id_docente as id_evaluador, id_estudiante as id_asignado, id_criterio,cri.nombre, niv.valoracion
        FROM tesis.evaluacion_pares_docente doc
		inner join tesis.tareas_envio env
		on env.id = doc.id_tarea
        inner join tesis.rubrica_criterios cri
        on cri.id = doc.id_criterio
        inner join tesis.rubrica_niveles niv
        on niv.id = doc.id_nivel
        where env.id_rubrica = $id_rubrica");

        return response()->json($cal);
    }
    public function get_c_est($id_rubrica){
        $cal2 = DB::connection('pgsql')->select("SELECT  est.id_asignado as id_evaluador, est.id_estudiante as id_asignado, par.id_criterio,cri.nombre,niv.valoracion
        FROM tesis.evaluacion_pares par
        inner join tesis.asignacion_estudiante est
        on est.id = par.id_asignacion_estudiante
        inner join tesis.asignacion_control con
        on con.id = est.id_asignacion
		inner join tesis.tareas_envio env
		on env.id = con.id_tarea
        inner join tesis.rubrica_criterios cri
        on cri.id = par.id_criterio
        inner join tesis.rubrica_niveles niv
        on niv.id = par.id_nivel
        where env.id_rubrica = $id_rubrica");

        return response()->json($cal2);
    }
    public function get_sum_tot_e($id_rubrica){
        $tot1 = DB::connection('pgsql')->select("SELECT est.id_asignado as id_evaluador, est.id_estudiante as id_asignado,sum(niv.valoracion) as suma
        FROM tesis.evaluacion_pares par
        inner join tesis.asignacion_estudiante est
        on est.id = par.id_asignacion_estudiante
        inner join tesis.asignacion_control con
        on con.id = est.id_asignacion
	    inner join tesis.tareas_envio env
		on env.id = con.id_tarea
        inner join tesis.rubrica_niveles niv
        on niv.id = par.id_nivel
        where env.id_rubrica = $id_rubrica
		group by est.id_asignado,est.id_estudiante");

        return response()->json($tot1);
    }
    public function get_sum_tot_d($id_rubrica){
        $tot2 = DB::connection('pgsql')->select("SELECT env.id_docente as id_evaluador, id_estudiante as id_asignado, sum(niv.valoracion) as suma
        FROM tesis.evaluacion_pares_docente doc
		inner join tesis.tareas_envio env
		on env.id = doc.id_tarea
        inner join tesis.rubrica_niveles niv
        on niv.id = doc.id_nivel
        where env.id_rubrica = $id_rubrica
		group by env.id_docente,id_estudiante");

        return response()->json($tot2);
    }
    public function actualizar_cvi(Request $request){
        $id_rubrica = $request->get('id_rubrica');
        $cvi = $request->get('cvi');
        $control = DB::connection('pgsql')->select("SELECT count(*)as general from tesis.estadisticas
      where id_rubrica = $id_rubrica");
      $existe = $control[0]->general;

      if($existe > 0){
         $act = DB::connection('pgsql')->update("UPDATE tesis.estadisticas
         SET  cvi_general= $cvi
         WHERE id_rubrica = $id_rubrica");
      }
      if($existe == 0){
        $act = DB::connection('pgsql')->insert("INSERT INTO tesis.estadisticas(
            id_rubrica, cvi_general,alfa_c,satisfa_validez)
            VALUES ($id_rubrica, $cvi,0,0)");
      }
      return response('ok');
    }
    public function alfa(Request $request){
        $id_rubrica = $request->get('id_rubrica');
        $alfa = $request->get('alfa');
        $control = DB::connection('pgsql')->select("SELECT count(*)as general from tesis.estadisticas
      where id_rubrica = $id_rubrica");
      $existe = $control[0]->general;

      if($existe > 0){
         $act = DB::connection('pgsql')->update("UPDATE tesis.estadisticas
         SET  alfa_c= $alfa
         WHERE id_rubrica = $id_rubrica");
      }
      if($existe == 0){
        $act = DB::connection('pgsql')->insert("INSERT INTO tesis.estadisticas(
            id_rubrica,cvi_general ,alfa_c,satisfa_validez)
            VALUES ($id_rubrica,0, $alfa,0)");
      }
      return response('ok');
    }
    public function satis(Request $request){
        $id_rubrica = $request->get('id_rubrica');
        $satis = $request->get('satis');
        $control = DB::connection('pgsql')->select("SELECT count(*)as general from tesis.estadisticas
      where id_rubrica = $id_rubrica");
      $existe = $control[0]->general;

      if($existe > 0){
         $act = DB::connection('pgsql')->update("UPDATE tesis.estadisticas
         SET  satisfa_validez= $satis
         WHERE id_rubrica = $id_rubrica");
      }
      if($existe == 0){
        $act = DB::connection('pgsql')->insert("INSERT INTO tesis.estadisticas(
            id_rubrica,cvi_general ,alfa_c, satisfa_validez)
            VALUES ($id_rubrica,0,0, $satis)");
      }
      return response('ok');
    }
    public function descarga_r(Request $request){
        $id_c = $request->get('id_campo');
        $id_dis = $request->get('id_dis');
        $id_subd = $request->get('id_subd');
        $descarga = DB::connection('pgsql')->select("SELECT rub.id as id_rubrica,rub.nombre, est.cvi_general,est.alfa_c as alfa,est.satisfa_validez as satisfaccion_validez
        FROM tesis.estadisticas est
        inner join tesis.rubricas rub
        on rub.id = est.id_rubrica
        where rub.id_campo = $id_c
        or rub.id_disciplina = $id_dis
        or rub.id_subdisciplina = $id_subd");
        return response()->json($descarga);
        //return $request;
    }
}
