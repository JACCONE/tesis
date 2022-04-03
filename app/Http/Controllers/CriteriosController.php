<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criterios;
use Illuminate\Support\Facades\DB; 

class CriteriosController extends Controller
{
    //
    public function index()
    {
        //
        $criterio =  Criterios::get();
        return response()->json($criterio);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //es para el front end devuelve la vista
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $criterio = new Criterios();
        $criterio->id_rubrica = $request->get('id_rubrica');
        $criterio->nombre = $request->get('nombre');
        $criterio->porcentaje = $request->get('porcentaje');
        
       if(!$criterio->save()){
        return response()->json(['message'=>'está mal',409]);
       }
       $ultimo=$criterio->id;
        return response()->json($ultimo);  
 }
 
 public function StoreMultiple(Request $request)
 {
     $ultimo= [];
     $datos = json_decode($request->getContent(), true);
     foreach($datos as $cri){
        $criterio = new Criterios();
        $criterio->id_rubrica = $cri['id_rubrica'];
        $criterio->nombre = $cri['nombre'];
        $criterio->porcentaje = $cri['porcentaje'];
        $criterio->save(); 
        array_push($ultimo, $criterio->id);
     }
     
        return response()->json($ultimo);  
     //return response()->json($datos);        
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_rubrica) // para consultar Criterios de determidad rubrica
    {
        //$nivel = niveles::find($id)->where('id_rubrica', 61);
        $cri = DB::connection('pgsql')->select("SELECT id, id_rubrica, UPPER(nombre)as nombre, porcentaje
        FROM tesis.rubrica_criterios where id_rubrica = $id_rubrica");
        //$cri = Criterios::where('id_rubrica', $id_rubrica)->get();
        //$nivel =niveles::select('id')
        //->where('id_rubrica', 61);
        return response()->json($cri);
        
    }
  /*   public function show(Rubrica $rubrica)
    {
        //
        return response()->json($rubrica);
        
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //es lo mismo que el de create
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_criterio)
    {
        $criterio = Criterios::find($id_criterio);
        $criterio->id_rubrica = $request->get('id_rubrica');
        $criterio->nombre = $request->get('nombre');
        $criterio->porcentaje = $request->get('porcentaje');
       
        
       // $rubrica->create($request->all());
       //$rubrica->save(); 
       if(!$criterio->save()){
        return response()->json(['message'=>'está mal',409]);
       }
        return response()->json(['message'=>'está ok',200]);  
        //$rubrica->update($request->all());
    }

    public function UpdateMultiple(Request $request)
    {
        $ultimo =[];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $cri){
           $criterio = Criterios::find($cri['id']);
           if ($criterio == null) {
             $criterio = new Criterios();
           }
           $criterio->id_rubrica = $cri['id_rubrica'];
           $criterio->nombre = $cri['nombre'];
           $criterio->porcentaje = $cri['porcentaje'];
           $criterio->save(); 
           array_push($ultimo, $criterio->id);
        }
        return response()->json($ultimo);        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_rubrica)
    {
        $criterio = Criterios::find($id_rubrica);
        if(!$criterio->delete()){
            return response()->json(['message'=>'está mal el eliminado'],409);
       }
        return response()->json(['message'=>'está ok eliminado'],200);  
        //
    }

    public function DeleteMultiple(Request $request) //se pasa un array  con los id [1,2,3], ejemplo en postman
    {
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $cri){     
            $criterio = Criterios::find($cri);
            $criterio->delete();
        }
        return response()->json(['message'=>'está ok eliminado'],200); 
    }
}
