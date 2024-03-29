<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Consulta
$idUser = $_GET["iduser"]; //El id del usuario
$roluser = $_GET["rolUser"]; //El id del usuario
$asignacionesUsuario = $consulta->getProjectsinfo($idUser); //Obtenemos las asignaciones del usuario
$notasCalificadasUsuario = $consulta->getPuntosByUser($idUser); //Obtenemos las notas asociadas del usuario

//Eliminamos el usuario
//Pasamos una capa de seguridad, al validar que no sea el usuario por defecto
if($idUser != 1){
    if( !(empty($notasCalificadasUsuario)) ){
        //Si es el usuario tiene notas asociadas, no se puede eliminar
        $estadoEliminaciones = false;
    }else{
        //Primero eliminamos todas sus asignaciones en el caso de que tenga asignaciones
        for ($i=0; $i < count($asignacionesUsuario); $i++) { 
            $estadoEliminaciones = $consulta->deleteAssignById($asignacionesUsuario[$i]["idasignacionJ"]);
        }
        //Por ultimo eliminamos su usuario
        $estadoEliminaciones = $consulta->deleteUserById($idUser);
    }
}else{
    //Si es el usuario por defecto, no se puede eliminar y da error
    $estadoEliminaciones = false;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Eliminar usuario</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($estadoEliminaciones){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">El usuario se ha eliminado con éxito.</p>
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
                <p class="lg:text-4xl text-red-900">Sucedio un error, el usuario no se ha eliminado correctamente.</p>
                <p class="lg:text-3xl text-red-900">Posibles causas</p>
                <p class="lg:text-2xl text-red-900">La cuenta que intento eliminar no se puede eliminar.</p>
                <p class="lg:text-2xl text-red-900">Es un jurado que tiene proyectos calificados, por lo que debe primero eliminar los datos de esas notas para poder eliminar al usuario asociado.</p>
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