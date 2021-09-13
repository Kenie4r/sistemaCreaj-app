<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/infoNivelesAprobacion.php");

$consulta = new Query; //Crear una consulta

//Guardar rubrica
$id_rubrica = $_POST["txtID"];
$name = $_POST["txtNombreRubrica"];
$id_materia = $_POST["txtMateria"];
$id_nivel = $_POST["txtNivel"];
$estadoRubrica = $consulta->saveRubrica($id_rubrica, $name, $id_materia, $id_nivel);

//Guardar criterios
$numeroCriterios = $_POST["siguienteCriterio"];

for($i = 0; $i < $numeroCriterios; $i++){
    $etiquetaNameCriterio = $i . "-txtNombreCriterio";
    $etiquetaPuntajeCriterio = $i . "-nbPuntaje";

    if( isset($_POST[$etiquetaNameCriterio]) ){
        $titulo = $_POST[$etiquetaNameCriterio];
        $puntajeCriterio = $_POST[$etiquetaPuntajeCriterio];
        $estadoCriterio = $consulta->saveCriterio($titulo, $puntajeCriterio, $id_rubrica);
        $id_criterio = $consulta->getIDCriterio($titulo, $id_rubrica);
        
        //Guardar niveles
        for($j = 0; $j < 4; $j++){
            $etiquetaDescriptioNivel = $i . "-" .  $j . "-descripcionNivel";

            $descriptionNivel = $_POST[$etiquetaDescriptioNivel];
            $range = $rangosNivelesAprobacion[$j];
            $note = $notasNivelesAprobacion[$j];
            $estadoNiveles = $consulta->savenAprobacion($descriptionNivel, $range, $note, $id_criterio[0]["idcriterios"]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($estadoRubrica == "Registro hecho"){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">La rúbrica se ha guardado con éxito.</p>
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
                <p class="lg:text-4xl text-red-900">Sucedio un error, la rúbrica no se ha guardado correctamente.</p>
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