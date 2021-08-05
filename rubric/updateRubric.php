<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/infoNivelesAprobacion.php");

$consulta = new Query; //Crear una consulta

//Traer los datos de la rúbrica
$id_rubrica = $_POST["txtID"];
$name = $_POST["txtNombreRubrica"];
$id_materia = $_POST["txtMateria"];
$id_nivel = $_POST["txtNivel"];

//Actualizar la rúbrica
$estadoRubrica = $consulta->updateRubrica($id_rubrica, $name, $id_materia, $id_nivel);

//Obtener datos de los criterios en las rúbricas
$numeroCriterios = $_POST["nCriterios"]; //Cuantos criterios hay
$ultimoCriterio = $_POST["siguienteCriterio"]; //Hasta que índice se llego en los criterios
$criteriosIDS = $consulta->getIdCriterioByIdRubric($id_rubrica); //Obtener los id de los criterios existentes en la base de datos

//Se repite el proceso según criterios existan en la rúbrica para guardar los nuevos y actualizar los viejos
for($i = 0; $i < $ultimoCriterio; $i++){
    //Se declarán las etiquetas con las que se guardan los datos de los criterios
    $etiquetaNameCriterio = $i . "-txtNombreCriterio"; //Nombre
    $etiquetaPuntajeCriterio = $i . "-nbPuntaje"; //Puntaje
    $etiquetaIdCriterio = $i . "-idcriterio"; //ID

    //Se verifica si existe el criterio, viendo si existe su input nombre
    if(isset($_POST[$etiquetaNameCriterio])){
        //Obtenemos los datos del criterio existente
        $id_criterio = $_POST[$etiquetaIdCriterio];
        $titulo = $_POST[$etiquetaNameCriterio];
        $puntajeCriterio = $_POST[$etiquetaPuntajeCriterio];

        //Verificamos si el criterio es viejo o no
        if(isset($criteriosIDS[$i]["idcriterios"]) && $id_criterio == $criteriosIDS[$i]["idcriterios"]){
            //Obtenemos los distintos id de los niveles del criterio
            $nivelesIDS = $consulta->getIdNivelByIdCriterio($criteriosIDS[$i]["idcriterios"]);

            //Actualizamos los niveles del criterio
            for($j = 0; $j < 4; $j++){
                //Las etiquetas para obtener los datos
                $etiquetaDescriptioNivel = $i . "-" .  $j . "-descripcionNivel";
                $etiquetaIdNivel = $i . "-" . $j . "-idnivel";

                //Obtenemos los datos del nivel
                $id_nivel = $_POST[$etiquetaIdNivel];
                $descriptionNivel = $_POST[$etiquetaDescriptioNivel];

                //Actualizar el nivel
                $estadoNiveles = $consulta->updateNAprobacion($id_nivel, $descriptionNivel);
            }
            
            //Actualizamos el criterio
            $estadoCriterio = $consulta->updateCriterio($id_criterio, $titulo, $puntajeCriterio);
        }else{
            //En el caso de que sea nuevoS
            //Guardamos el criterio
            $estadoCriterio = $consulta->saveCriterio($titulo, $puntajeCriterio, $id_rubrica);
            $id_criterio = $consulta->getIDCriterio($titulo, $id_rubrica); //Obtenemos el id del recien creado criterio

            //Guardar niveles
            for($j = 0; $j < 4; $j++){
                $etiquetaDescriptioNivel = $i . "-" .  $j . "-descripcionNivel";
                $etiquetaIdNivel = $i . "-" . $j . "-idcriterio";
                $descriptionNivel = $_POST[$etiquetaDescriptioNivel];
                $range = $rangosNivelesAprobacion[$j];
                $note = $notasNivelesAprobacion[$j];
                $estadoNiveles = $consulta->savenAprobacion($descriptionNivel, $range, $note, $id_criterio[0]["idcriterios"]);
            }
        }
        
    }
    
}

//Si encontramos que no existe el id de un criterio viejo de la rúbrica, lo eliminamos
for ($i=0; $i < count($criteriosIDS); $i++) {
    //Etiqueta ID criterios
    $etiquetaIdCriterio = $i . "-idcriterio"; 
    if(!isset($_POST[$etiquetaIdCriterio])){
        //Eliminar niveles
        $niveles = $consulta->getIdNivelByIdCriterio($criteriosIDS[$i]["idcriterios"]);
        for($j = 0; $j < 4; $j++){
            $estadoNiveles = $consulta->deleteNivelesAById($niveles[$j]["idnaprobacion"]);
        }

        //Eliminar criterio
        $estadoCriterio = $consulta->deleteCiterioById($criteriosIDS[$i]["idcriterios"]);
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
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($estadoRubrica){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">La rúbrica se ha actualizado con éxito.</p>
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
                <p class="lg:text-4xl text-red-900">Sucedio un error, la rúbrica no se ha actualizado correctamente.</p>
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