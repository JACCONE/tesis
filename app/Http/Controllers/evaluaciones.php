<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion_Calificacion;
use App\Models\Evaluacion_Suficiencia;
use Illuminate\Support\Facades\DB; 
class evaluaciones extends Controller
{
    //
    public function update_evaluacion(Request $request){
      $id_eva = $request->get('id_evaluacion');
      $id_ite = $request->get('id_item');
      $cohe = $request->get('coherencia');
      $rele = $request->get('relevancia');
      $clar = $request->get('claridad');
      $obse = $request->get('observacion');

      $existe = DB::connection('pgsql')->select("SELECT count(*)as existe
      FROM tesis.evaluaciones_calificaciones
      WHERE id_evaluacion = $id_eva
      AND id_item = $id_ite");
      if($existe[0]->existe > 0){
        $actual = DB::connection('pgsql')->update("UPDATE  tesis.evaluaciones_calificaciones
        SET coherencia = $cohe,
        relevancia = $rele,
        claridad = $clar,
        observacion = '$obse'
        WHERE id_evaluacion = $id_eva
        AND id_item = $id_ite");
      }else{
        $actual = DB::connection('pgsql')->insert("INSERT  INTO tesis.evaluaciones_calificaciones
        (id_evaluacion, id_item, coherencia,relevancia,claridad,observacion)
        VALUES($id_eva,$id_ite, $cohe,$rele,$clar,'$obse')"); 
      }
              /* $datos = json_decode($request->getContent(), true);
        
        foreach($datos as $evaluacion){
           //$temp_id = $evaluacion['id'];
           $eval = Evaluacion_Calificacion::find($evaluacion['id']);
           if ($eval == null) {
             $eval = new Evaluacion_Calificacion();
           }
           $eval->id_evaluacion = $evaluacion['id_evaluacion'];
           $eval->id_item = $evaluacion['id_item'];
           $eval->coherencia = $evaluacion['coherencia'];
           $eval->relevancia = $evaluacion['relevancia'];
           $eval->claridad = $evaluacion['claridad'];
           $eval->observacion = $evaluacion['observacion'];
           $eval->save(); 
        } */
        return response()->json($actual);  
    }
    public function update_suficiencia(Request $request){
      $id_eva = $request->get('id_evaluacion');
      $id_cri = $request->get('id_criterio');
      $sufi = $request->get('suficiencia');
      $existe = DB::connection('pgsql')->select("SELECT count(*)as existe
           FROM tesis.evaluaciones_suficiencia
           WHERE id_evaluacion = $id_eva
           AND id_criterio = $id_cri
           ");
      if($existe[0]->existe > 0){
        $actual = DB::connection('pgsql')->update("UPDATE  tesis.evaluaciones_suficiencia
        SET suficiencia = $sufi
        WHERE id_evaluacion = $id_eva
        AND id_criterio = $id_cri");
      }else{
        $actual = DB::connection('pgsql')->insert("INSERT  INTO tesis.evaluaciones_suficiencia
        (id_evaluacion, id_criterio, suficiencia)
        VALUES($id_eva,$id_cri, $sufi)"); 
      }
       /*  $datos = json_decode($request->getContent(), true);
        
        foreach($datos as $evaluacion){
           //$temp_id = $evaluacion['id'];
           
           $eval_s = Evaluacion_Suficiencia::find($evaluacion['id']);
           if ($eval_s == null) {
             $eval_s = new Evaluacion_Suficiencia();
           }
           $eval_s->id_evaluacion = $evaluacion['id_evaluacion'];
           $eval_s->id_criterio = $evaluacion['id_criterio'];
           $eval_s->suficiencia = $evaluacion['suficiencia'];
           $eval_s->save(); 
        } */
        return response()->json($actual);  
    }
    public function get_suficiencia(Request $request){
      $datos = json_decode($request->getContent(), true);
      $id_evaluacion = $datos['id_evaluacion'];
      $id_criterio = $datos['id_criterio'];
      $info = DB::connection('pgsql')->select("SELECT id,suficiencia 
      from tesis.evaluaciones_suficiencia
      where id_evaluacion = '$id_evaluacion'
      and id_criterio = '$id_criterio'
      ");
      return response()->json($info);
    }
    public function get_evaluacion(Request $request){
      //$datos = json_decode($request->getContent(), true);
      $id_eva = $request->get('id_eva');
      $id_item = $request->get('id_item');
      
      $info = DB::connection('pgsql')->select("SELECT id,coherencia,relevancia,claridad,observacion
      FROM tesis.evaluaciones_calificaciones
      where id_evaluacion = '$id_eva'
      and id_item = $id_item
      ");  
      return response()->json($info);
    }

    public function finalizar_evaluacion(Request $request){
      $id_eva = $request->get('id_eva');
      $id_rubrica = $request->get('id_rubrica');
      $email = $request->get('email');
      $tipo = $request->get('tipo');
      $observacion = $request->get('observacion');

      $criterios = DB::connection('pgsql')->select("SELECT count(*) as criterios from tesis.rubrica_criterios 
      where id_rubrica = $id_rubrica");

      $items = DB::connection('pgsql')->select("SELECT count(*)as items from tesis.criterios_items ite
      inner join tesis.rubrica_criterios cri
      on cri.id = ite.id_criterio
      and cri.id_rubrica = $id_rubrica");

      $eva_suf = DB::connection('pgsql')->select("SELECT count(*)as suficiencia FROM tesis.evaluaciones_suficiencia eva
      inner join tesis.rubrica_criterios cri
      on cri.id = eva.id_criterio
      and cri.id_rubrica = $id_rubrica
      and eva.id_evaluacion = $id_eva
      ");

      $eva_gen = DB::connection('pgsql')->select("SELECT count(*)as general from tesis.evaluaciones_calificaciones eva
      inner join tesis.criterios_items ite
      on ite.id = eva.id_item
      inner join tesis.rubrica_criterios cri
      on cri.id = ite.id_criterio
      and cri.id_rubrica = $id_rubrica
      and eva.id_evaluacion = $id_eva
      ");

      $d1 = $criterios[0]->criterios;
      $d2 = $items[0]->items;
      $d3 = $eva_suf[0]->suficiencia;
      $d4 = $eva_gen[0]->general;
      $finalizado = 0;
      if($d1 == $d3 && $d2 == $d4){
        $finalizado = 1;
      }else{
        $finalizado = 0;
      }
      // actualizar el estado de evaluación
      if($finalizado == 1){
        $sql = "UPDATE tesis.evaluaciones SET estado = 'EVALUADO' WHERE id = $id_eva";
        $ejec = DB::connection('pgsql')->update($sql);

        $obs = "INSERT INTO tesis.observacion_evaluacion(id_evaluacion, id_rubrica, observacion)
          VALUES ($id_eva, $id_rubrica, '$observacion')";
          $ejecucion = DB::connection('pgsql')->insert($obs);

        //validamos cuantos evaluaciones existen y cuantas estan realizadas para estado de la rubrica
        $total = DB::connection('pgsql')->select("SELECT COUNT(*)as total from tesis.evaluaciones
        where id_rubrica = $id_rubrica;
        ");

        $total_eva = DB::connection('pgsql')->select("SELECT COUNT(*)as total from tesis.evaluaciones
        where id_rubrica = $id_rubrica
        and estado ='EVALUADO';
        ");
        if($total[0]->total >= 5){
          if($total[0]->total == $total_eva[0]->total){
            $actualizar = DB::connection('pgsql')->select("UPDATE tesis.rubricas
            SET  estado='EVALUADA'
            WHERE id = $id_rubrica");
          }
        }
      }

      //validar si es externo y no tiene más evaluaciones anular clave
      $inactivar="";
      if($tipo == 'EXTERNO'){
        $rubr = DB::connection('pgsql')->select("SELECT count(*)as total
        FROM tesis.rubricas rub
        inner join tesis.evaluaciones eva
        on eva.id_rubrica = rub.id
		    inner join tesis.expertos exp
		    on exp.id = eva.id_experto
        where exp.email= '$email'
        and rub.estado = 'EVALUACION'
		    and eva.estado = 'EVALUANDO';
        ");

        if($rubr[0]->total == 0){
          $inactivar = DB::connection('pgsql')->delete("DELETE FROM tesis.expertos_temp_users
          WHERE usuario = '$email'");
        }
      }
      //probar  array_push($ultimo, $criterio->id);
      return response()->json($finalizado);
      //return response($finalizado);

      //realizar comparaciones

    }
}
