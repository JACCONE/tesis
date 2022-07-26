<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Autenticacion;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\datos_principales;
use App\Http\Controllers\expertos;
use App\Http\Controllers\CriteriosController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\DescripcionesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RubricaController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\evaluaciones;
use App\Http\Controllers\tareasController;
use App\Http\Controllers\estadisticasController;
use App\Http\Controllers\unesco;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//para sesiones
Route::post('/autenticar', [Autenticacion::class,'login'])->name('autenticar');
Route::post('/autenticar_p', [Autenticacion::class,'login'])->name('autenticar_p.login');
Route::post('/autenticar/externos', [Autenticacion::class,'login_externos'])->name('autenticar_externos');

Route::post('/registrar', [Autenticacion::class,'usuario'])->name('registrar');
Route::delete('/logout', [Autenticacion::class,'salir'])->name('logout');
Route::get('/home', [Autenticacion::class,'sesion'])->name('home');

//para modulos
Route::get('modulos/{rol}',[ModulosController::class,'get_modulos'])->name('modulos.get_modulos');

//rubricas
Route::get('rub_general/{id_docente}',[datos_principales::class,'get_rubricas'])->name('rub_general.get_rubrica');
Route::get('rub_general/experto/{id_externo}',[datos_principales::class,'get_rubricas_externos'])->name('rub_general.get_rubricas_externos');


Route::post('rubrica',[RubricaController::class,'store'])->name('rubrica.store');
Route::post('rubrica/multiple',[RubricaController::class,'StoreMultiple'])->name('rubrica.StoreMultiple');
Route::delete('rubrica/{id_rubrica}',[RubricaController::class,'destroy'])->name('rubrica.destroy');
Route::put('rubrica',[RubricaController::class,'UpdateMultiple'])->name('rubrica.UpdateMultiple');
Route::delete('rubrica',[RubricaController::class,'DeleteMultiple'])->name('rubrica.DeleteMultiple');
//para criterios
Route::post('criterio',[CriteriosController::class,'store'])->name('criterio.store');
Route::post('criterio/multiple',[CriteriosController::class,'StoreMultiple'])->name('criterio.StoreMultiple');
Route::get('criterio/{id}',[CriteriosController::class,'show'])->name('criterio.show');
Route::put('criterio',[CriteriosController::class,'UpdateMultiple'])->name('criterio.UpdateMultiple');
//para niveles
Route::post('niveles/multiple',[NivelesController::class,'StoreMultiple'])->name('niveles.StoreMultiple');
Route::get('niveles/{id}',[NivelesController::class,'show'])->name('rubrica.show');
//para descripciones de nivel por criterio
Route::post('descripciones/multiple',[DescripcionesController::class,'StoreMultiple'])->name('descripciones.StoreMultiple');
Route::post('descripciones/multiple/show',[DescripcionesController::class,'showMultiple'])->name('descripciones.showMultiple');
//para items por criterio
Route::post('items/multiple',[ItemsController::class,'StoreMultiple'])->name('items.StoreMultiple');
Route::post('items/multiple/show',[ItemsController::class,'showMultiple'])->name('items.showMultiple');
Route::put('items',[ItemsController::class,'UpdateMultiple'])->name('items.UpdateMultiple');

//expertos
Route::get('expertos/{id_rubrica}',[expertos::class,'get_expertos'])->name('expertos.get_expertos');
Route::post('expertos/insertar',[expertos::class,'set_expertos'])->name('expertos_insertar.set_expertos');
Route::post('evaluaciones',[expertos::class,'set_evaluaciones'])->name('evaluaciones.set_evaluaciones');
Route::get('expertos/docente_filtros/{like}',[expertos::class,'get_docentes_filtro'])->name('expertos_docente.get_docentes_filtro');
Route::put('expertos/update_estado',[expertos::class,'update_estado'])->name('update_estado.update_estado');
Route::post('experto/sender',[expertos::class,'mailfuncion'])->name('test.mailfuncion');
Route::post('experto/sendInvitation',[expertos::class,'sendInvitation'])->name('test.sendInvitation');
Route::post('experto/changeStatus',[expertos::class,'setStatus'])->name('test.setStatus');
Route::delete('experto/delete/{id_experto}',[expertos::class,'deleteExperto'])->name('test.deleteExperto');
Route::post('experto/sendRubric',[expertos::class,'sendRubric'])->name('test.sendRubric');
Route::post('experto/getRubricaNombre/{id_rubrica}',[expertos::class,'getRubricaNombre'])->name('test.getRubricaNombre');
//para periodos
Route::get('periodo',[datos_principales::class,'get_periodo'])->name('periodos.get_periodos');

//para materias
Route::get('materias/{id_periodo}/{id_docente}',[datos_principales::class,'get_materias'])->name('materias.get_materias');
Route::get('paralelos/{id_periodo}/{id_docente}/{id_materia}',[datos_principales::class,'get_paralelos'])->name('paralelos.get_paralelos');
Route::get('asignaturas',[datos_principales::class,'get_asignaturas'])->name('asignaturas.get_asignaturas');
Route::get('rubricas_tarea/{id_docente}',[datos_principales::class,'get_rubricas_tarea'])->name('rubricas_tarea.get_rubricas_tarea');




//para asignaturas
Route::put('asignatura',[AsignaturasController::class,'update_asignatura'])->name('asignaturas.update_asignatura');

//para evaluaciones de rubrica por expertos
Route::put('evaluacion/general',[evaluaciones::class,'update_evaluacion'])->name('evaluacion_general.update_evaluacion');
Route::put('evaluacion/suficiencia',[evaluaciones::class,'update_suficiencia'])->name('evaluacion_suficiencia.update_suficiencia');
Route::post('obtener/suficiencia',[evaluaciones::class,'get_suficiencia'])->name('obtener_suficiencia.get_suficiencia');
Route::post('obtener/evaluacion',[evaluaciones::class,'get_evaluacion'])->name('obtener_evaluacion.get_evaluacion');

Route::put('rubrica/estado',[RubricaController::class,'update_estado'])->name('rurbica_estado.update_estado');
Route::post('finalizar/evaluacion',[evaluaciones::class,'finalizar_evaluacion'])->name('finalizar_evaluacion.finalizar_evaluacion');

//para tareas
Route::post('update_tarea',[tareasController::class,'update_tareas'])->name('update_tarea.update_tareas');
Route::get('get_tareas_docente/{id_docente}',[tareasController::class,'get_tareas'])->name('get_tareas_docente.get_tareas');
Route::post('estudiante_paralelo',[tareasController::class,'get_estudiantes_paralelo'])->name('estudiante_paralelo.get_estudiantes_paralelo');
Route::post('estudiante_tareas',[tareasController::class,'get_tareas_estudiantes'])->name('estudiante_tareas.get_tareas_estudiantes');
Route::post('estudiante/materias',[tareasController::class,'get_materias_estudiante'])->name('estudiante_materias.get_materias_estudiante');
Route::put('tareas_envio',[tareasController::class,'actualizar_tarea_envio'])->name('tareas_envio.actualizar_tarea_envio');
Route::post('estado_evaluacion',[tareasController::class,'asignacion_estado'])->name('estado_evaluacion.asignacion_estado');
Route::put('tarea_control',[tareasController::class,'act_tareas_control'])->name('tarea_control.act_tareas_control');
Route::put('tarea_asignaciones',[tareasController::class,'act_asignacion_estudiante_general'])->name('tarea_asignaciones.act_asignacion_estudiante_general');
Route::get('get_asignaciones/{id_tarea}',[tareasController::class,'get_asignaciones_general'])->name('get_asignaciones.get_asignaciones_general');
Route::get('get_asignaciones_tarea/{id_tarea}',[tareasController::class,'get_asignaciones'])->name('get_asignaciones_tarea.get_asignaciones');
Route::get('get_asignaciones_eval/{id_estudiante}',[tareasController::class,'get_asignaciones_estudiantes'])->name('get_asignaciones_eval.get_asignaciones_estudiantes');
Route::put('evaluacion_pares_estudiante',[tareasController::class,'guardar_evaluacion_pares'])->name('evaluacion_pares_estudiante.guardar_evaluacion_pares');
Route::get('question_satisfaccion/{tipo}',[tareasController::class,'get_satisfaccion_question'])->name('question_satisfaccion.get_satisfaccion_question');
Route::post('guardar_cuestionario',[tareasController::class,'save_cuestionario'])->name('guardar_cuestionario.save_cuestionario');
Route::get('validar_cuestionario/{rubrica}/{estudiante}',[tareasController::class,'control_cuestionario'])->name('validar_cuestionario.control_cuestionario');
Route::get('get_asignaciones_doce/{id_docente}',[tareasController::class,'get_asignaciones_docente'])->name('get_asignaciones_doce.get_asignaciones_docente');
Route::put('evaluacion_pares_docente',[tareasController::class,'guardar_evaluacion_docente'])->name('evaluacion_pares_docente.guardar_evaluacion_docente');
Route::get('get_notas_docente/{id_tarea}',[tareasController::class,'get_notas_docente'])->name('get_notas_docente.get_notas_docente');

//PARA GETOR DE CALCULOS Y ESTADISTICAS
Route::get('get_rub_eval/{id_docente}',[estadisticasController::class,'get_rub_evaluadas'])->name('get_rub_eval.get_rub_evaluadas');
Route::get('get_exp_rub/{id_rubrica}',[estadisticasController::class,'get_expertos_rubricas'])->name('get_exp_rub.get_expertos_rubricas');
Route::get('get_cri_rub_eval/{id_rubrica}',[estadisticasController::class,'get_crit_eval'])->name('get_cri_rub_eval.get_crit_eval');
Route::get('get_ite_eval/{id_rubrica}',[estadisticasController::class,'get_ite_eval'])->name('get_ite_eval.get_ite_eval');
Route::get('get_cal_suficiencia/{id_rubrica}',[estadisticasController::class,'get_cal_suf'])->name('get_cal_suficiencia.get_cal_suf');
Route::get('get_cal_generales/{id_rubrica}',[estadisticasController::class,'get_eva_rub_gen'])->name('get_cal_generales.get_eva_rub_gen');
Route::get('get_obs_generales/{id_rubrica}',[estadisticasController::class,'get_obs_eva'])->name('get_obs_generales.get_obs_eva');
Route::get('get_control_eva/{id_rubrica}',[estadisticasController::class,'get_control_eva'])->name('get_control_eva.get_control_eva');
Route::get('get_cue_pre/{id_rubrica}',[estadisticasController::class,'get_cuestionario_preguntas'])->name('get_cue_pre.get_cuestionario_preguntas');
Route::get('get_calif_satis_vali/{id_rubrica}',[estadisticasController::class,'get_cuestionario_calificaciones'])->name('get_calif_satis_vali.get_cuestionario_calificaciones');
Route::get('get_total_est/{id_rubrica}',[estadisticasController::class,'get_total_estu'])->name('get_total_est.get_total_estu');
//peticiones para alfa de cronbanch
Route::get('get_cali_doc/{id_rubrica}',[estadisticasController::class,'get_c_doc'])->name('get_cali_doc.get_c_doc');
Route::get('get_cali_est/{id_rubrica}',[estadisticasController::class,'get_c_est'])->name('get_cali_est.get_c_est');
Route::get('get_tar_doc/{id_docente}/{id_rubrica}',[estadisticasController::class,'get_t_doc'])->name('get_tar_doc.get_t_doc');
Route::get('get_totale/{id_rubrica}',[estadisticasController::class,'get_sum_tot_e'])->name('get_totale.get_sum_tot_e');
Route::get('get_totald/{id_rubrica}',[estadisticasController::class,'get_sum_tot_d'])->name('get_totald.get_sum_tot_d');

//peticiones para datos unesco
Route::get('get_campos_u',[unesco::class,'get_campos'])->name('get_campos_u.get_campos');
Route::get('get_disciplinas_u/{id_campo}',[unesco::class,'get_disciplinas'])->name('get_disciplinas_u.get_disciplinas');
Route::get('get_subdisciplinas_u/{id_disciplina}',[unesco::class,'get_subdisciplinas'])->name('get_subdisciplinas_u.get_subdisciplinas');
Route::put('save_campo',[unesco::class,'save_campo'])->name('save_campo.save_campo');
Route::put('update_campo',[unesco::class,'update_campo'])->name('update_campo.update_campo');
Route::put('save_dis',[unesco::class,'save_dis'])->name('save_dis.save_dis');
Route::put('update_dis',[unesco::class,'update_dis'])->name('update_dis.update_dis');
Route::put('save_sdis',[unesco::class,'save_sdis'])->name('save_sdis.save_sdis');
Route::put('update_sdis',[unesco::class,'update_sdis'])->name('update_sdis.update_sdis');

