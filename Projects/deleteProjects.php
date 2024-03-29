<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

//Verificar session

$consulta = new Query; //Crear una consulta

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Eliminar Proyecto</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
$proyecto_idproyecto = $_GET["idequipo"];
$contador = $consulta->isSavedProjectID($proyecto_idproyecto);
if($contador == $proyecto_idproyecto){
    ?>
    <section class="container">
                <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
                    <div class="m-4 lg:m-7 text-center">
                        <p class="lg:text-4xl text-red-900">El proyecto ya fue calificado no se puede eliminar.</p>
                    </div>
                    <div class="m-4 lg:m-7 flex justify-center">
                        <a href="index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
                    </div>
                </div>
            </section>
   <?php     
}else{
    //Eliminar equipos

$idestudiante= $consulta-> getIdestudianteByIdproyecto($proyecto_idproyecto);
$idestudiantes=$consulta->getIDestudiantes($proyecto_idproyecto);



 if(empty($idestudiantes)){
     
    $deleteEquipo= $consulta-> deleteequipo($proyecto_idproyecto);
    $deleteProyecto= $consulta-> deleteprojects($proyecto_idproyecto);
    ?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">Se ha eliminado con éxito el proyecto.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
<?php
 }else{
    foreach($idestudiantes as $valor){
        $id_estudiantes = $valor;
        $deleteEstudiantes= $consulta-> deleteStudents($id_estudiantes);
    }
    $deleteEquipo= $consulta-> deleteequipo($proyecto_idproyecto);
    $deleteProyecto= $consulta-> deleteprojects($proyecto_idproyecto);
    if($deleteEquipo == "Hecho" && $deleteProyecto == "Hecho" &&  $deleteEstudiantes ==  "Hecho"){
        ?>
            <section class="container">
                <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
                    <div class="m-4 lg:m-7 text-center">
                        <p class="lg:text-4xl text-green-900">Se ha eliminado con éxito el proyecto.</p>
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
                        <p class="lg:text-4xl text-red-900">Sucedio un error, el proyecto no se ha eliminado correctamente.</p>
                    </div>
                    <div class="m-4 lg:m-7 flex justify-center">
                        <a href="index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
                    </div>
                </div>
            </section>
            <?php
        }
}
}
?>
</body>
</html>