<?php
namespace App\Classes;

class Mail{

    public function sender($to, $body){

        $mail = new \PHPMailer\PHPMailer\PHPMailer();
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
        $mail->Subject = "INVITACIÓN A EVALUAR DISEÑO DE RÚBRICA";
        $mail->Body = $body;
        $mail->IsHTML(true);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
        return 1;
    }
}

?>