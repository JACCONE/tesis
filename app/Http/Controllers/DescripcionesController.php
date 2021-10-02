<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\descripciones; 
class DescripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function StoreMultiple(Request $request)
    {
        $ultimo = [];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $des){
           $descripcion = new descripciones();
           $descripcion->id_criterio = $des['id_criterio'];
           $descripcion->id_nivel = $des['id_nivel'];
           $descripcion->descripcion = $des['descripcion'];
           $descripcion->save(); 
           array_push($ultimo, $descripcion->id);
        }
        return response()->json($ultimo);        
    }
    public function show($id)
    {
        //
    }
    public function showMultiple(Request $request)
    {
        $ultimo= [];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $des){
           $descripcion = descripciones::where('id_criterio', $des['id_criterio'])->get(); 
           foreach($descripcion as $des2){
            array_push($ultimo, $des2);
           }
           
           /*
           $st = isset($descripcion[0]) ? $descripcion[0] : false;
            if ($st){
                
            }
            
           if(isset($descripcion)){
                
           }else{
            
           }
           */
        }
         return response()->json($ultimo);  
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
