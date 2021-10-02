<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RubricaController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\CamposController;
use App\Http\Controllers\SubdisciplinasController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\ExpertosController;
use App\Http\Controllers\CriteriosController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\DescripcionesController;
use App\Http\Controllers\ItemsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('index/{id}',[RurbricaController::class,'show'])->name('index.show');
Route::get('disciplinas',[DisciplinasController::class,'index'])->name('disciplinas.index');
Route::get('campos',[CamposController::class,'index'])->name('campos.index');
Route::get('subdisciplinas',[SubdisciplinasController::class,'index'])->name('subdisciplinas.index');
Route::get('asignaturas',[AsignaturasController::class,'index'])->name('asignaturas.index');
Route::get('rubrica',[RubricaController::class,'index'])->name('rubrica.index');
Route::get('expertos',[ExpertosController::class,'index'])->name('expertos.index');
//Route::get('rubrica',[RubricaController::class,'index'])->name('rubrica.index');
Route::post('rubrica',[RubricaController::class,'store'])->name('rubrica.store');
Route::post('rubrica/multiple',[RubricaController::class,'StoreMultiple'])->name('rubrica.StoreMultiple');
//Route::put('rubrica/{id_rubrica}',[RubricaController::class,'update'])->name('rubrica.update');
Route::delete('rubrica/{id_rubrica}',[RubricaController::class,'destroy'])->name('rubrica.destroy');
Route::put('rubrica',[RubricaController::class,'UpdateMultiple'])->name('rubrica.UpdateMultiple');
Route::delete('rubrica',[RubricaController::class,'DeleteMultiple'])->name('rubrica.DeleteMultiple');

//Route::get('rubrica/{id}',[RubricaController::class,'show'])->name('rubrica.show');

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
