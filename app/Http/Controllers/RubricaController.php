<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rubrica;
use Illuminate\Support\Facades\DB; 

class rubricaController extends Controller
{
    //
    public function index()
    {
        //
        $rubrica =  rubrica::get();
        return response()->json($rubrica);
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
        $rubrica = new rubrica();
        $rubrica->id_asignatura = $request->get('id_asignatura');
        $rubrica->id_docente = $request->get('id_docente');
        $rubrica->nombre = $request->get('nombre');
        $rubrica->descripcion = $request->get('descripcion');
        $rubrica->id_campo = $request->get('id_campo');
        $rubrica->id_disciplina = $request->get('id_disciplina');
        $rubrica->id_subdisciplina = $request->get('id_subdisciplina');
        $rubrica->estado = $request->get('estado');
        
       if(!$rubrica->save()){
        return response()->json(['message'=>'está mal',409]);
       }
       $ultimo=$rubrica->id;
        return response()->json($ultimo);  
 }
 
 public function StoreMultiple(Request $request)
 {
     $datos = json_decode($request->getContent(), true);
     foreach($datos as $rub){
        $rubrica = new rubrica();
        $rubrica->id_asignatura = $rub['id_asignatura'];
        $rubrica->id_docente = $rub['id_docente'];
        $rubrica->nombre = $rub['nombre'];
        $rubrica->descripcion = $rub['descripcion'];
        $rubrica->estado = $rub['estado'];
        $rubrica->save(); 
     }
     return response()->json($datos);        
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_rubrica)
    {
        $rubrica = rubrica::find($id_rubrica);   
        return response()->json($rubrica);
        
    }
  /*   public function show(rubrica $rubrica)
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
    public function update(Request $request, $id_rubrica)
    {
        $rubrica = rubrica::find($id_rubrica);
        $rubrica->id_asignatura = $request->get('id_asignatura');
        $rubrica->id_docente = $request->get('id_docente');
        $rubrica->nombre = $request->get('nombre');
        $rubrica->descripcion = $request->get('descripcion');
        $rubrica->estado = $request->get('estado');
        
       // $rubrica->create($request->all());
       //$rubrica->save(); 
       if(!$rubrica->save()){
        return response()->json(['message'=>'está mal',409]);
       }
        return response()->json(['message'=>'está ok',200]);  
        //$rubrica->update($request->all());
    }
    public function UpdateMultiple(Request $request)
    {
        $datos = json_decode($request->getContent(), true);
        
        foreach($datos as $rub){
           //$temp_id = $rub['id'];
           $rubrica = rubrica::find($rub['id']);
           if ($rubrica == null) {
             $rubrica = new rubrica();
           }
           $rubrica->id_asignatura = $rub['id_asignatura'];
           $rubrica->id_docente = $rub['id_docente'];
           $rubrica->nombre = $rub['nombre'];
           $rubrica->descripcion = $rub['descripcion'];
           $rubrica->estado = $rub['estado'];
           $rubrica->save(); 
        }
        return response()->json($datos);        
    }

/*
    public function UpdateMultiple(Request $request)
    {
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $rub){
           $rubrica = rubrica::find($rub['id']);
           $rubrica->id_asignatura = $rub['id_asignatura'];
           $rubrica->id_docente = $rub['id_docente'];
           $rubrica->nombre = $rub['nombre'];
           $rubrica->descripcion = $rub['descripcion'];
           $rubrica->estado = $rub['estado'];
           $rubrica->save(); 
        }
        return response()->json($datos);        
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_rubrica)
    {
        $rubrica = rubrica::find($id_rubrica);
        if(!$rubrica->delete()){
            return response()->json(['message'=>'está mal el eliminado'],409);
       }
        return response()->json(['message'=>'está ok eliminado'],200);  
        //
    }

    public function DeleteMultiple(Request $request) //se pasa un array  con los id [1,2,3], ejemplo en postman
    {
        $datos = json_decode($request->getContent(), true);
        if($datos != null){
        foreach($datos as $rub){     
            $rubrica = rubrica::find($rub);
            $rubrica->delete();
        }
        return response()->json(['message'=>'está ok eliminado'],200); 
       }else{
        return response()->json(['message'=>'es nuevo no necesita eliminacion'],200); 
       }
        
    }
    public function update_estado(Request $request){
        //$datos = json_decode($request->getContent(), true);
        $id_rubrica = $request->get('id_rub');
        $estado = $request->get('estado');
      /*   $id_rubrica = $datos['id_rubrica'];
        $estado = $datos['estado']; */
        $info = DB::connection('pgsql')->select("
        UPDATE tesis.rubricas
        SET estado='$estado'
        WHERE id = $id_rubrica
        ");
        return response()->json($info);
       
    }
}
