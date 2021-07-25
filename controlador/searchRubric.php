<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$rubricas = $consulta->searchRubricById($_POST["idrubric"]); //Get rúbricas

if(!empty($rubricas)){
    for ($i=0; $i < count($rubricas); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-4'>" . $rubricas[$i]["idrubrica"] . "</td>";
        echo "\t<td class='p-4'>" . $rubricas[$i]["nombre"] . "</td>";
        echo "\t<td class='p-4'><a href='rubric.php?idrubric=" . $rubricas[$i]["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-eye'></span> Ver</a></td>";
        echo "\t<td class='p-4'><a href='editRubric.php?idrubric=" . $rubricas[$i]["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
        echo "\t<td class='p-4'><a href='deleteRubric.php?idrubric=" . $rubricas[$i]["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-cross'></span> Eliminar</a></td>";
        echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay ninguna rúbrica con ese ID<td>";
    echo "</tr>";
}

?>