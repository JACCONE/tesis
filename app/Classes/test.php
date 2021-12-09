<?php

namespace App\Classes;
include("Mailer\src\PHPMailer.php");
include("Mailer\src\Exception.php");
include("Mailer\src\SMTP.php");
include("MailClass.php");

class test{

    function prueba($to,$params){
        $mail = new Mail();

        $body = file_get_contents("invitacion_experto.html",true);
        //$body = 'HOLA $P{NOMBRE}, $P{CORREO_DOCENTE}, $P{DOCENTE}';

            foreach($params as $k=>$v){
                $body = str_replace('$P{'.$k.'}', $v, $body);
            }

        return $mail->sender($to,$body);
    }
}

?>