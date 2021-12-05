<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    //
    public function get_modulos($rol){
        $info = DB::connection('pgsql')->select("SELECT mod.id, nombre_modulo, plantilla_modulo, icon, extra, acceso.type FROM tesis.modulos as mod inner join tesis.modulo_acceso as acceso on acceso.id_modulo = mod.id where acceso.rol = '$rol'");
        return response()->json($info, 200);

    }

}
