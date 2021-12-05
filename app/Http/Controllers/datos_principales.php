<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class datos_principales extends Controller
{
    //
    public function get_rubricas($id_docente){
        $info = DB::connection('pgsql')->select(
        "SELECT rub.id, rub.nombre, rub.descripcion, asi.id as asignatura, rub.estado 
        FROM tesis.rubricas rub
        inner join tesis.asignaturas as asi
        on asi.id = rub.id_asignatura
        where rub.id_docente = $id_docente
        ORDER BY rub.id ASC "
        );
        return response()->json($info, 200);

    }
    public function get_periodos(){
        $info = DB::connection('pgsql')->select(
        "SELECT idperiodo, nombre FROM esq_periodos_academicos.periodo_academico where actual = 'S' AND idtipo_periodo in (1,4,9,8)"
        );
        return response()->json($info, 200);

    }
    public function get_asignaturas(){
        $info = DB::connection('pgsql')->select(
            "SELECT idmateria, nombre FROM esq_mallas.materia
            where habilitado = 'S'"
            );
            return response()->json($info, 200);
    }
    
    public function get_materias($id_periodo,$id_docente){
        $info = DB::connection('pgsql')->select(
            "SELECT 
            d.id_docente,
            p.nombres || ' ' || p.apellido1 || '' || p.apellido2 AS docente,
            d.id_materia,
            m.nombre AS materia
            FROM (
                SELECT
                    da.idpersonal AS id_docente,
                    id.idmateria AS id_materia
                FROM esq_inscripciones.inscripcion_detalle id
                JOIN esq_distributivos.distribucion_academica da 
                    ON id.iddistributivo = da.iddistributivo 
                    AND id.idperiodo = $id_periodo
                    AND da.idpersonal = $id_docente
                GROUP BY id.idmateria, da.idpersonal
            ) AS d
            JOIN esq_mallas.materia m 
                ON m.idmateria = d.id_materia
            JOIN esq_datos_personales.personal p 
            ON p.idpersonal = d.id_docente"
            );
            return response()->json($info, 200);

    }
}
