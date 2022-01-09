<?php

namespace App\Classes;
include("Mailer\src\PHPMailer.php");
include("Mailer\src\Exception.php");
include("Mailer\src\SMTP.php");
include("MailClass.php");

class test{

    function prueba($to,$params){
        $mail = new Mail();
        $subject = "INVITACIÓN A EVALUAR DISEÑO DE RÚBRICA";
        $body = file_get_contents("invitacion_experto.html",true);
        //$body = 'HOLA $P{NOMBRE}, $P{CORREO_DOCENTE}, $P{DOCENTE}';

            foreach($params as $k=>$v){
                $body = str_replace('$P{'.$k.'}', $v, $body);
            }

        return $mail->sender($to,$body,$subject);
    }

    function sendRubric($to, $params){
        $mail = new Mail();
        $subject = "ACCESO PARA EVALUAR RUBRICA";
        $body = file_get_contents("send_rubric.html", true);

        foreach ($params as $k => $v) {
            $body = str_replace('$P{' . $k . '}', $v, $body);
        }

        return $mail->sender($to, $body,$subject);
    }
}

?>