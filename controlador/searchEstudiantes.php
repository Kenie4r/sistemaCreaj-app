<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
if($_POST["tiporubric"] == "id"){
    $estudiantes = $consulta->searchAlumnosById($_POST["filtrorubric"]); //Get estudiantes by id
}else{
    $estudiantes = $consulta->searchEstudiantesByName($_POST["filtrorubric"]); //Get estudiantes by nombre
}

if(!empty($estudiantes)){
    for ($i=0; $i < count($estudiantes); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-6'>" . $estudiantes[$i]["idestudiante"] . "</td>";
        echo "\t<td class='p-6'>" . $estudiantes[$i]["nombre"] . "</td>";
        echo "\t<td class='p-6'>" . $estudiantes[$i]["apellidos"] . "</td>";
        echo "\t<td class='p-6'><a href='editStudents.php?student=" . $estudiantes[$i]["idestudiante"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
        echo "\t<td class='p-6'><a href='deleteStudents.php?student=" . $estudiantes[$i]["idestudiante"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
        echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay ningun estudiante con ese " . $_POST["tiporubric"] . "<td>";
    echo "</tr>";
}

?>