<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
if($_POST["tiporubric"] == "id"){
    $proyectos = $consulta->searchProyectById($_POST["filtrorubric"]); //Get Proyectos by id
}else{
    $proyectos = $consulta->searchProyectsByName($_POST["filtrorubric"]); //Get Proyectos by nombre
}

if(!empty($proyectos)){
    for ($i=0; $i < count($proyectos); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-6'>" . $proyectos[$i]["idproyecto"] . "</td>";
        echo "\t<td class='p-6'>" . $proyectos[$i]["nombreProyecto"] . "</td>";
        echo "\t<td class='p-6'>" . $proyectos[$i]["descripcion"] . "</td>";
        echo "\t<td class='p-6'><a href='editProjects.php?idproject=" . $proyectos[$i]["idproyecto"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
        echo "\t<td class='p-6'><a href='deleteProjects.php?idequipo=" . $proyectos[$i]["idproyecto"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
        echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay ningun proyecto con ese " . $_POST["tiporubric"] . "<td>";
    echo "</tr>";
}

?>