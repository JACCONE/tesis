<?php
include("Mailer\src\PHPMailer.php");
include("Mailer\src\Exception.php");
include("Mailer\src\SMTP.php");

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

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->Username = "vectressplay@gmail.com";
    $mail->Password = "vvykmszejqpoamdu";
    $mail->SetFrom("vectressplay@gmail.com");
    $mail->Subject = "INIVITACIÓN A EVALUAR DISEÑO DE RÚBRICA";
    $mail->Body = $body;
    $mail->IsHTML(true);
    $mail->AddAddress($to);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
} catch (Exception $e) {
    echo "ERROR DE INSTANCIA";
}
