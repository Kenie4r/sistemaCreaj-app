<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/sendEmail.php");

$consulta = new Query; //Crear una consulta

//Guardamos las variables de nuevo perfil
$username = $_POST["txtUserProfile"];
$name = $_POST["txtNameProfile"];
$last_name = $_POST["txtLastNameProfile"];
$rol = $_POST["txtRolProfile"];
$password = $_POST["txtPassProfile"];
$email = $_POST["txtEmailProfile"];

//GUARDAR
$estadoUsuario = $consulta->saveUser($username, $name, $last_name, $rol, $password, $email);

//Enviamos un correo notificando al usuario sobre sus datos de inicio de sesión
//Configuramos unos datos de la función
$year = date("Y"); //Año actual
$pass = "donboscoSV";
$asunto = "Sistema de Calificacion Crea J: Nueva usuario";
$saludo = "Bienvenido/a a nuestro sistema";
//Envío
$estadoCorreo = enviarCorreo($email, $name, $username, $year, $asunto, $saludo, $pass);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar usuario</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($estadoUsuario == "Hecho"){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">El usuario se ha guardado con éxito.</p>
                <p class="lg:text-2xl text-green-900"><?php echo $estadoCorreo; ?></p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
<?php
}else{
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, el usuario no se ha guardado correctamente.</p>
                <p class="lg:text-2xl text-red-900"><?php echo $estadoCorreo; ?></p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <?php
}
?>
</body>
</html>