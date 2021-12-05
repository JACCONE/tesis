<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;

class ItemsController extends Controller
{
    //
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
    public function StoreMultiple(Request $request)
    {
        $ultimo = [];
        $datos = json_decode($request->getContent(), true);
        foreach($datos as $ite){
           $it = new items();
           $it->id_criterio = $ite['id_criterio'];
           $it->nombre = $ite['nombre'];
           $it->andamiaje = $ite['andamiaje'];
           $it->save(); 
           array_push($ultimo, $it->id);
        }
        return response()->json($ultimo);        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_criterio)
    {
              //$item = niveles::find($id);
              $ite = items::where('id_criterio', $id_criterio)->get();
              return response()->json($ite);
    }


    public function showMultiple(Request $request)
    {
        $ultimo= [];
        $datos = json_decode($request->getContent(), true);
        
        foreach($datos as $cri){
           $ite = items::where('id_criterio', $cri['id_criterio'])->get(); 
           foreach($ite as $ite2){
            array_push($ultimo, $ite2);
           }
           //array_push($ultimo, $ite[0]);
        }
         return response()->json($ultimo);  
    }
    public function UpdateMultiple(Request $request)
    {
        $datos = json_decode($request->getContent(), true);
        
        foreach($datos as $ite){
           $item_n = items::find($ite['id']);
           
           if ($item_n == null) {
             $item_n = new items();
           }
           $item_n->id_criterio = $ite['id_criterio'];
           $item_n->nombre = $ite['nombre'];
           $item_n->andamiaje = $ite['andamiaje'];
           $item_n->save(); 
           
        }
        return response()->json($datos);        
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
