<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\test;

class expertos extends Controller{

    public function deleteExperto($id_experto){
        $sql = "DELETE FROM tesis.expertos WHERE id = $id_experto;";
        $info = DB::connection('pgsql')->delete($sql);
        return response()->json($info, 200);
    }

    public function setStatus(Request $request){
        $id_rubrica = $request->get('id_rubrica');
        $id_experto = $request->get('id_experto');
        $estado = $request->get('estado');
        $response =[];
        $resinterno = $this->update_estado($estado,$id_rubrica,$id_experto);
        array_push($response,$resinterno);
        return $response;
    }

    public function sendInvitation(Request $request){
        $to = $request->get('to');
        $id_rubrica = $request->get('id_rubrica');
        $id_experto = $request->get('id_experto');
        $response =[];

        $datos = json_decode($request->getContent(), true);
        $a = new test();
        $resultado_envio = 1;// $a->prueba($to,$datos);

        if($resultado_envio == 1){
            $resinterno = $this->update_estado("INVITADO",$id_rubrica,$id_experto);
        }

        array_push($response,$resinterno);
        return $response;
    }

    //PRIMER ENVIO A INVITAR
    public function mailfuncion(Request $request){

        $datos = json_decode($request->getContent(), true);
        $response =[];
        $resinterno = null;
        
        foreach($datos as $cri){
            $a = new test();
            $resultado_envio = $a->prueba($cri['to'],$cri);
            
            if($resultado_envio == 1){
                $resinterno = $this->update_estado("INVITADO",$cri['id_rubrica'],$cri['id_experto']);
                
            }

            array_push($response,$resinterno);
        }
        return $resinterno;
    }

    public function get_expertos($id_rubrica){
        $info = DB::connection('pgsql')->select("SELECT * FROM tesis.expertos exp
        inner join tesis.evaluaciones eva
        on exp.id = eva.id_experto
        where eva.id_rubrica = $id_rubrica order by exp.id desc");

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
        $email = $request->get('email');
        $info = DB::connection('pgsql')->insert("INSERT INTO tesis.expertos(
        nombres, apellidos, formacion_academica, cargo_actual, institucion, pais, anios_experiencia,email)
        VALUES ('$nombre','$apellidos','$formacion','$cargo','$institucion','$pais','$anios','$email');");

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

    public function get_docentes_filtro($like){

        $sql = "SELECT concat(p.nombres,' ',p.apellido1,' ',p.apellido2) as nombre_select,
        p.idpersonal,p.apellido1,p.apellido2,p.nombres,p.correo_personal_institucional as correo,
        trol.id_rol,trol.descripcion as rol,string_agg(formacion.titulo_obtenido,', ') as titulo, string_agg(uni.nombre,', ') as universidades
        FROM esq_datos_personales.personal as p
        INNER JOIN esq_roles.tbl_personal_rol as rol ON p.idpersonal = rol.id_personal
        INNER JOIN esq_roles.tbl_rol as trol ON rol.id_rol = trol.id_rol
        LEFT JOIN esq_datos_personales.p_formacion_profesional as formacion ON p.idpersonal = formacion.idpersonal
        LEFT JOIN esq_datos_personales.p_universidad as uni ON formacion.iduniversidad = uni.iduniversidad
        WHERE trol.id_rol = 5 AND rol.estado = 'S' AND (p.nombres LIKE '%$like%' OR p.apellido1 LIKE '%$like%' OR p.apellido2 LIKE '%$like%') 
        group by p.idpersonal,trol.id_rol,p.nombres,p.apellido1,p.apellido2,p.correo_personal_institucional,
		trol.descripcion;";

        $info = DB::connection('pgsql')->select($sql);
        return response()->json($info, 200);
    }

    public function update_estado($estado,$idrubrica,$idexperto){

        $sql = "UPDATE tesis.evaluaciones SET estado = '$estado' WHERE id_rubrica = $idrubrica AND id_experto = $idexperto;";
        $info = DB::connection('pgsql')->update($sql);
        return response()->json($info, 200);
    }
}
