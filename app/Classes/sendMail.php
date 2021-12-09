<?php

include("Mailer\src\PHPMailer.php");
include("Mailer\src\Exception.php");
include("Mailer\src\SMTP.php");
include("MailClass.php");

try{

    $to = $_GET['to'];
    $list = $_SERVER['QUERY_STRING'];



    parse_str($list, $params);

    $body = file_get_contents("invitacion_experto.html");

        if(isset($params)){
            foreach($params as $k=>$v){
                $body = str_replace('$P{'.$k.'}', $v, $body);
            }
        }

    $mail = new Mail();
    echo $mail->sender($to,$body);

} catch (Exception $e) {
    echo "ERROR DE INSTANCIA";
}