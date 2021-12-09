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
Route::post('/registrar', [Autenticacion::class,'usuario'])->name('registrar');
Route::delete('/logout', [Autenticacion::class,'salir'])->name('logout');
Route::get('/home', [Autenticacion::class,'sesion'])->name('home');

//para modulos
Route::get('modulos/{rol}',[ModulosController::class,'get_modulos'])->name('modulos.get_modulos');

//rubricas
Route::get('rub_general/{id_docente}',[datos_principales::class,'get_rubricas'])->name('rub_general.get_rubrica');
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

//para periodos
Route::get('periodos',[datos_principales::class,'get_periodos'])->name('periodos.get_periodos');

//para materias
Route::get('materias/{id_periodo}/{id_docente}',[datos_principales::class,'get_materias'])->name('materias.get_materias');
Route::get('asignaturas',[datos_principales::class,'get_asignaturas'])->name('asignaturas.get_asignaturas');

//para asignaturas
Route::put('asignatura',[AsignaturasController::class,'update_asignatura'])->name('asignaturas.update_asignatura');
