<?php
//Recursos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

namespace PHPMailer\PHPMailer;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'trabajosocialcdbhelp@gmail.com';
        $mail->Password   = 'hSaYweXa38';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;


$xd = $mail->smt->verify("");

if($xd){
    echo "l";
}else{
    echo "np";
}
?>