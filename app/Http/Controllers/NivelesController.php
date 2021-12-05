<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\niveles;

class NivelesController extends Controller
{
    //
    public function index()
    {
        //
        $nivel =  niveles::get();
        return response()->json($nivel);
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
        $nivel = new niveles();
        $nivel->id_rubrica = $request->get('id_rubrica');
        $nivel->valoracion = $request->get('valoracion');
        $nivel->nombre = $request->get('nombre');
        
       if(!$nivel->save()){
        return response()->json(['message'=>'está mal',409]);
       }
        return response()->json(['message'=>'está ok',200]);  
    }

    public function StoreMultiple(Request $request)
    {
        $ultimo= [];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $niv){
           $nivel = new niveles();
           $nivel->id_rubrica = $niv['id_rubrica'];
           $nivel->valoracion = $niv['valoracion'];
           $nivel->nombre = $niv['nombre'];
           $nivel->save(); 
           array_push($ultimo, $nivel->id);
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
    public function show($id)
    {

        //$nivel = niveles::find($id)->where('id_rubrica', 61);
        $niv = niveles::where('id_rubrica', $id)->get();
        //$nivel =niveles::select('id')
        //->where('id_rubrica', 61);
        return response()->json($niv);
        
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
