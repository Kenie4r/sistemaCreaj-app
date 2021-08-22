<?php
//Recursos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function enviarCorreo($correo, $nombre, $username, $pass, $year){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'trabajosocialcdbhelp@gmail.com';
        $mail->Password   = 'hSaYweXa38';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('trabajosocialcdbhelp@gmail.com', 'Soporte: CDB');
        $mail->addAddress($correo);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Sistema de ayuda: TS';
        $mail->Body    = '
    <html>
    <body style="margin:0%; padding: 0%; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <section style="display: grid; grid-template-rows: 0.25fr 1fr 0.25fr; box-shadow: 5px 10px 20px rgba(0,0,0,.6); border-radius: 5px;">
            <article style="grid-row-start: 1; grid-row-end: 2;  padding: 1em; text-align: center; font-weight: bold; background-color: darkcyan; border-radius: 5px 5px 0px 0px;">Sistema de calificación de Crea J</article>
            <article style="grid-row-start: 2; grid-row-end: 3;  padding: 1em;">
                <p>Hola <span style="font-weight: bold;">' . $nombre . '</span>. Bienvenido/a 
                a nuestro sistema, tus datos para iniciar sesión son:</p>
                <p>Nombre de usuario: <span style="font-weight: bold;">' . $username . '</span></p>
                <p>Contraseña: <span style="font-weight: bold;">' . $pass . '</span></p>
            </article>
            <article style="grid-row-start: 3; grid-row-end: 4; background-color: silver; padding: 1em;  border-radius: 0px 0px 5px 5px; text-align: center;">- Copyright Colegio Don Bosco ' . $year . ' -</article>
        </section>
    </div>
    </body>
    </html>
        ';

        $mail->send();
        return "Correo enviado.";
    } catch (Exception $e) {
        echo "Algo salio mal. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>