<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function disciplina()
    {
        return view('disciplina');
    }
    public function informacion()
    {
        return view('informacion');
    }
}
/*Formas de pasar variables a vistas
    public function informacion($variable){
        return view('informacion',['recibo' => $variable]);  //la variable con la que se recibe en la vista seria 'recibo'  
    }

    segunda forma
    public function informacion($variable){
        //compact('variable'); // retorna ['variable' => $variable]
        return view('informacion',compact('variable'));  //la variable con la que se recibe en la vista seria 'recibo'  //$recibo
    }
*/