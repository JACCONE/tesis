<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class unesco extends Controller
{
    //
    public function get_campos(){
        $info = DB::connection('pgsql')->select("SELECT id,nombre 
        from tesis.campos_unesco where estado = 1");
        return response()->json($info);
      }
      public function get_disciplinas($id_campo){
        $id = $id_campo;
        $info2 = DB::connection('pgsql')->select("SELECT id, nombre
        FROM tesis.disciplinas_unesco 
        where id_campo = $id
        and estado = 1");
        return response()->json($info2);
      }
      public function get_subdisciplinas($id_disciplina){
        $id = $id_disciplina;
        $info3 = DB::connection('pgsql')->select("SELECT id,nombre
        FROM tesis.subdisciplinas_unesco
        where id_disciplina = $id
        and estado = 1");
        return response()->json($info3);
      }
      public function save_campo(Request $campo){
        $nombre = $campo->get('nombre');
       $info = DB::connection('pgsql')->insert("INSERT INTO tesis.campos_unesco(
          nombre, estado)VALUES ('$nombre', 1)");
          return response()->json($info, 200);
          //return $campo->get('nombre');
      }
      public function update_campo(Request $campo){
        $nombre = $campo->get('nombre');
        $id = $campo->get('id');
        $info = DB::connection('pgsql')->update("UPDATE tesis.campos_unesco
        SET nombre = '$nombre'
        WHERE id=$id and estado = 1");
          return response()->json($info, 200);
      }
      public function save_dis(Request $disciplina){
        $nombre = $disciplina->get('nombre');
        $id_campo = $disciplina->get('id_campo');
       $info = DB::connection('pgsql')->insert("INSERT INTO tesis.disciplinas_unesco(
        id_campo, estado, nombre)
        VALUES ( $id_campo, 1, '$nombre')");
          return response()->json($info, 200);
          //return $campo->get('nombre');
      }
      public function update_dis(Request $disciplina){
        $nombre = $disciplina->get('nombre');
        $id = $disciplina->get('id');
        $info = DB::connection('pgsql')->update("UPDATE tesis.disciplinas_unesco
        SET  nombre = '$nombre'
        WHERE id=$id and estado = 1");
          return response()->json($info, 200);
      }
      public function save_sdis(Request $subdisciplina){
        $nombre = $subdisciplina->get('nombre');
        $id_disciplina = $subdisciplina->get('id_disciplina');
       $info = DB::connection('pgsql')->insert("INSERT INTO tesis.subdisciplinas_unesco(
        id_disciplina, nombre, estado)
          VALUES ($id_disciplina, '$nombre', 1)");
          return response()->json($info, 200);
          //return $campo->get('nombre');
      }
      public function update_sdis(Request $subdisciplina){
        $nombre = $subdisciplina->get('nombre');
        $id = $subdisciplina->get('id');
        $info = DB::connection('pgsql')->update("UPDATE tesis.subdisciplinas_unesco
        SET  nombre = '$nombre'
        WHERE id=$id and estado = 1");
          return response()->json($info, 200);
      }
}
