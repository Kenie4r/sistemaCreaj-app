<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Consulta
$idUser = $_POST["usuario"]; //El id del usuario
$asignacionesUsuario = $consulta->getProjectsinfo($idUser); //Todas las asignaciones previas del jurado
$cantidadAsignacionesFormulario = $_POST["cantidadAsignaciones"]; //Cuantas asignaciones estaban en el form

//Recorremos todas las asignaciones devueltas por el formulario
for ($i=0; $i < $cantidadAsignacionesFormulario; $i++) { 
    //Declaramos variables que nos serviran para obtener valores del formulario
    $etiquetaIdAsignacion = $i . "-id-item-asignacion";
    $etiquetaMateria = $i . "-sltMateria";
    $etiquetaGrado = $i . "-sltGrade";

    //Si el id de las asignacion esta vacío es porque no existe previamente y debe crearse
    if(empty($_POST[$etiquetaIdAsignacion])){
        //Verificamos que no esten vacíos sus datos
        if(!( empty($_POST[$etiquetaMateria]) &&  empty($_POST[$etiquetaGrado]))){
            $idMatter = $_POST[$etiquetaMateria];
            $idGrade = $_POST[$etiquetaGrado];
            $estadoAsignaciones = $consulta->saveAsignacionj($idUser, $idMatter, $idGrade);
        }
    }else{
        //Si el id de las asignaciones tiene un valor previo, debemos actualizar el dato
        //Verificamos que no esten vacíos sus datos
        if(!( empty($_POST[$etiquetaMateria]) &&  empty($_POST[$etiquetaGrado]))){
            $idAsignacion = $_POST[$etiquetaIdAsignacion];
            $idMatter = $_POST[$etiquetaMateria];
            $idGrade = $_POST[$etiquetaGrado];
            $estadoAsignaciones = $consulta->updateAsignacion($idAsignacion, $idUser, $idMatter, $idGrade);
        }
    }
}

//Por ultimo recorremos el array de asignaciones previas, si hay una asignacion que no estaba en el form
//es porque la eliminaron del form, por lo tanto la eliminamos de la base
for ($i=0; $i < count($asignacionesUsuario); $i++) { 
    $etiquetaIdAsignacion = $i . "-id-item-asignacion";

    if(!isset($_POST[$etiquetaIdAsignacion])){
        $estadoEliminaciones = $consulta->deleteAssignById($asignacionesUsuario[$i]["idasignacionJ"]);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar asignación</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($estadoAsignaciones == "Hecho"){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">Las asignaciones se han guardado con éxito.</p>
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
                <p class="lg:text-4xl text-red-900">Sucedio un error, las asignaciones no se han guardado correctamente.</p>
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