<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$rubricas = $consulta->searchRubricsByIdAndName($_POST["namerubric"]); //Get rúbricas by nombre and name
$contador = 0;
$idActual = trim($_POST["idrubric"]);

if($rubricas > 0){
    foreach ($rubricas as $key => $rubrica) {
        foreach ($rubrica as $key2 => $id) {
            $id = trim($id);
            if($id != $idActual){
                $contador++;
            }
        }
    }
}

echo $contador;

?>