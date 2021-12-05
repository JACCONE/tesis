<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class expertos extends Controller
{
    //
    public function get_expertos($id_rubrica){
        $info = DB::connection('pgsql')->select("SELECT *FROM tesis.expertos exp
        inner join tesis.evaluaciones eva
        on exp.id = eva.id_experto
        where eva.id_rubrica = $id_rubrica");

        return response()->json($info, 200);
    }
    public function set_expertos(Request $request){
        $nombre = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $formacion = $request->get('formacion');
        $cargo = $request->get('cargo');
        $institucion = $request->get('institucion');
        $pais = $request->get('pais');
        $anios = $request->get('anios');
        $info = DB::connection('pgsql')->insert("INSERT INTO tesis.expertos(
        nombre, apellidos, formacion_academica, cargo_ctual, institucion, pais, anios_experiencia)
        VALUES ('$nombre','$apellidos','$formacion','$cargo','$institucion','$pais','$anios');");

        return response()->json($info, 200);
    }

    public function set_evaluaciones(Request $request){
        $id_exp = DB::connection('pgsql')->select("SELECT id FROM tesis.expertos xp
        order by id desc limit 1");   
        $id_rubrica = $request->get('id_rubrica');
        $estado = $request->get('estado');
        $id_experto = $id_exp[0]->id;
        $info = DB::connection('pgsql')->insert("INSERT INTO tesis.evaluaciones(
            id_rubrica, id_experto, estado)
           VALUES ($id_rubrica, $id_experto, '$estado');");
         
        return response()->json($info, 200);
    }



}
