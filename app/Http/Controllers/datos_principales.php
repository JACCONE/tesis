<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class datos_principales extends Controller
{
    //
    public function get_rubricas($id_docente){
        $info = DB::connection('pgsql')->select(
        "SELECT rub.id, rub.nombre, rub.descripcion,rub.id_campo, rub.id_disciplina, rub.id_subdisciplina, asi.id as asignatura, rub.estado 
        FROM tesis.rubricas rub
        inner join tesis.asignaturas as asi
        on asi.id = rub.id_asignatura
        where rub.id_docente = $id_docente
        ORDER BY rub.id ASC"
        );
        return response()->json($info, 200);

    }
    public function get_rubricas_externos($correo){
        $info = DB::connection('pgsql')->select(
        "SELECT rub.id, eva.id as id_evaluacion, rub.nombre, rub.descripcion, rub.estado
        FROM tesis.rubricas rub
        inner join tesis.evaluaciones eva
        on eva.id_rubrica = rub.id
		inner join tesis.expertos exp
		on exp.id = eva.id_experto
        where exp.email= '$correo'
        and rub.estado = 'EVALUACION'
        and eva.estado = 'EVALUANDO'"
        );
        return response()->json($info, 200);
    }
    public function get_rubricas_externos_eval($correo){
        $info = DB::connection('pgsql')->select(
        "SELECT rub.id, eva.id as id_evaluacion, rub.nombre, rub.descripcion, rub.estado
        FROM tesis.rubricas rub
        inner join tesis.evaluaciones eva
        on eva.id_rubrica = rub.id
		inner join tesis.expertos exp
		on exp.id = eva.id_experto
        where exp.email= '$correo'
        and eva.estado = 'EVALUADO'"
        );
        return response()->json($info, 200);
    }
    public function get_id_exp($correo){
        $info = DB::connection('pgsql')->select(
        "SELECT id as id_experto ,nombres
        FROM tesis.expertos where email= '$correo'"
        );
        return response()->json($info, 200);
    }
    
    public function get_rubricas_tarea($id_personal){
        $info = DB::connection('pgsql')->select(
        "SELECT id, nombre
        FROM tesis.rubricas 
        where id_docente= '$id_personal'
        and estado IN ('EVALUADA','EN USO')"
        );
        return response()->json($info, 200);
    }
    
    public function get_periodo(){
        $info = DB::connection('pgsql')->select(
        "SELECT idperiodo, nombre
        from esq_periodos_academicos.periodo_academico p 
        where p.idtipo_periodo=1 and p.actual='S';"
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
            "SELECT d.id_materia,
            d.id_docente,
            m.nombre
            FROM (
                SELECT
                    da.idpersonal AS id_docente,
                    id.idmateria AS id_materia,
                    da.idparalelo AS id_paralelo
                FROM esq_inscripciones.inscripcion_detalle id
                JOIN esq_distributivos.distribucion_academica da 
                    ON id.iddistributivo = da.iddistributivo 
                    AND id.idperiodo = $id_periodo
                    AND da.idpersonal = $id_docente
                GROUP BY id.idmateria, da.idpersonal,da.idparalelo
            ) AS d
            JOIN esq_mallas.materia m 
                ON m.idmateria = d.id_materia
            JOIN esq_datos_personales.personal p 
            ON p.idpersonal = d.id_docente
            GROUP BY d.id_materia,
            d.id_docente,m.nombre"
            );
            return response()->json($info, 200);

    }
    public function get_paralelos($id_periodo,$id_docente,$id_materia){
        $info = DB::connection('pgsql')->select(
            "SELECT pa.idparalelo, pa.nombre FROM
            ( 
                SELECT d.id_materia,
                    d.id_paralelo AS id_paralelo
                    FROM (
                        SELECT
                        da.idpersonal AS id_docente,
                        id.idmateria AS id_materia,
                        da.idparalelo AS id_paralelo
                        FROM esq_inscripciones.inscripcion_detalle id
                        JOIN esq_distributivos.distribucion_academica da 
                        ON id.iddistributivo = da.iddistributivo 
                        AND id.idperiodo = $id_periodo
                        AND da.idpersonal = $id_docente
                        AND id.idmateria = $id_materia
                        GROUP BY id.idmateria, da.idpersonal,da.idparalelo
                    ) AS d
                JOIN esq_mallas.materia m 
                    ON m.idmateria = d.id_materia
                JOIN esq_datos_personales.personal p 
                    ON p.idpersonal = d.id_docente
                    GROUP BY d.id_materia,
                    d.id_paralelo)AS e
            JOIN esq_distributivos.paralelo pa
            on pa.idparalelo = e.id_paralelo
            GROUP BY pa.idparalelo , pa.nombre"
            );
            return response()->json($info, 200);

    }
}
