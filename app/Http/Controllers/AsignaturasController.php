<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignaturas; 

class AsignaturasController extends Controller
{
    //
    public function update_asignatura(Request $request){
        $ultimo =[];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $asi){
            $asignatura = asignaturas::find($asi['id']);
           if ($asignatura == null) {
             $asignatura = new asignaturas();
           }
           $asignatura->id = $asi['id'];
           $asignatura->id_subdisciplina = $asi['id_subdisciplina'];
           $asignatura->nombre = $asi['nombre'];
           $asignatura->estado = $asi['estado'];
           $asignatura->save();  
           array_push($ultimo, $asignatura->id);
        }
        return $ultimo; 

    }
}
