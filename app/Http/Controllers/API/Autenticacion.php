<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\usuario;
use Illuminate\Support\Facades\Hash; 

class Autenticacion extends Controller
{
    public function login(Request $request){
        $datos = json_decode($request->getContent(), true);
        $email = $datos['email'];
        $pass = $datos['password'];
        $info = DB::connection('pgsql')->select("SELECT esq_roles.fnc_login_2_desarrollo( '$email', '$pass', '', '', '', '', '', 0, '')as data");
        $data = str_replace('"','',$info[0]->data); 
        $data = str_replace('(','',$data); 
        $data = str_replace(')','',$data);
        $info_split = explode(',', $data);
        
        $r_error = $info_split[0]; 
        $r_idpersonal = $info_split[1]; 
        $r_cedula = $info_split[2]; 
        $r_nombres = $info_split[3]; 
        $r_password_changed = $info_split[4]; 
        $r_mail_alternativo = $info_split[5]; 
        $r_conexion = $info_split[8]; 
        $rol = '';
        if (strpos($r_conexion, 'DOCENTE') !== false) {
            $rol = "DOCENTE";
        } 
        elseif(strpos($r_conexion, 'ESTUDIANTE') !== false){
            $rol = "ESTUDIANTE";
        } 
        $jsonRespuesta = [ 'error' => $r_error, 'id_personal' => $r_idpersonal,'rol' => $rol, 'cedula' => $r_cedula, 'nombres' => $r_nombres, 'password_changed' => $r_password_changed, 'mail_alternativo' => $r_mail_alternativo];
        return response()->json($jsonRespuesta, 200);

    }

    public function usuario(Request $request)
    {
        $idpersonal = $request->get('id_personal');
        $pass = Hash::make($request->get('password'));

        $existe = DB::connection('pgsql')->select("SELECT id FROM tesis.usuarios_sesion WHERE id_personal = '$idpersonal'");
        if ($existe == null) {
            $usu = new usuario();
            //return 'no existe';
        }else{
           /*  $id_existe = $existe[0];*/
            $usu = usuario::find($existe[0]->id); 
            //return $existe[0]->id;
        }
        $usu-> id_personal = $request->get('id_personal');
        $usu-> rol = $request->get('rol');
        $usu-> cedula = $request->get('cedula');
        $usu-> nombres = $request->get('nombres');
        $usu-> email = $request->get('email');
        $usu-> password = $pass;
        $usu->save();  
        //redirect()->intended('/api/home');
        
        return $usu;
        
 }

 public function sesion()
 {
     $idpersonal = '';
     if( isset($_COOKIE['TOKEN_1']) )
    {
        $idpersonal = $_COOKIE['TOKEN_1'];
    }
    else
    {
        $idpersonal = 'no';
    }
    $existe = DB::connection('pgsql')->select("SELECT id FROM tesis.usuarios_sesion WHERE id_personal = '$idpersonal'");
    if ($existe == null) {
        return redirect()->intended('/');
        //return 'no existe';
    }else{
       // $id_existe = $existe[0];
      // return view('layout/principal');
        //return $existe[0]->id;
        return view('layout/initial');
    }  
    
 }

    public function salir(Request $request)
    {
        $idpersonal = '';
        if( isset($_COOKIE['TOKEN_1']) )
        {
            $idpersonal = $_COOKIE['TOKEN_1'];
        }else
        {
        $idpersonal = 'no';
    }
        $accion = DB::connection('pgsql')->delete("DELETE FROM tesis.usuarios_sesion WHERE id_personal = '$idpersonal'");
        return $accion;
    } 

    public function validar()
    {
        $idpersonal = '';
        if( isset($_COOKIE['TOKEN_1']) )
        {
            return redirect()->intended('/api/home');
        }else
        {
            return view('login');
    }
    }
}
