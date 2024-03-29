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
    <title>Crea J | Eliminar rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');

$idrubric = $_GET["idrubric"];
$criterios = $consulta->getIdCriterioByIdRubric($idrubric);

for($i = 0; $i < count($criterios); $i++){
    if(isset($criterios[$i]["idcriterios"])){
        //Eliminar niveles
        $niveles = $consulta->getIdNivelByIdCriterio($criterios[$i]["idcriterios"]);
        for($j = 0; $j < 4; $j++){
            if(isset($niveles[$j]["idnaprobacion"])){
                $estadoNiveles = $consulta->deleteNivelesAById($niveles[$j]["idnaprobacion"]);
            }
        }

        //Eliminar criterio
        $id_criterio = $consulta->deleteCiterioById($criterios[$i]["idcriterios"]);
    }
}

//Eliminar rubrica
$estadoRubrica = $consulta->deleteRubricById($idrubric);

if($estadoRubrica == "Hecho"){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">La rúbrica se ha eliminado con éxito.</p>
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
                <p class="lg:text-4xl text-red-900">Sucedio un error, la rúbrica no se ha eliminado correctamente.</p>
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