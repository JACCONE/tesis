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

