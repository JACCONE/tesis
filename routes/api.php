<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RurbricaController;
use App\Http\Controllers\DisciplinasUnesco;

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

Route::get('index/{id}',[RurbricaController::class,'show'])->name('index.show');
Route::get('disciplinas',[DisciplinasUnesco::class,'index'])->name('disciplinas.index');
