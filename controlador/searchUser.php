<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$usuarios = $consulta->searchUserByName($_POST["nameUser"]); //Get rúbricas

if(!empty($usuarios)){
    for ($i=0; $i < count($usuarios); $i++) { 
        echo "<tr class='lol'>";
    echo "\t<td class='p-4'>" . $usuarios[$i]["usario"] . "</td>";
    echo "\t<td class='p-4'>" . $usuarios[$i]["nombres"] . "</td>";
    echo "\t<td class='p-4'>" . $usuarios[$i]["apellidos"] . "</td>";
    echo "\t<td class='p-4'>" . $usuarios[$i]["rol"] . "</td>";
    echo "\t<td class='p-4'>" . $usuarios[$i]["email"] . "</td>";
    echo "\t<td class='p-4'><a href='#' class='hover:text-blue-900'><span class='icon-eye'></span> Ver</a></td>";
    echo "\t<td class='p-4'><a href='#' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
    echo "\t<td class='p-4'><a href='deleteRubric.php?idrubric=variable' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
    echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='8' class='p-4'><span class='icon-blocked'></span> No hay usuarios en el sistema con ese nombre</td>";
    echo "</tr>";
}

?>