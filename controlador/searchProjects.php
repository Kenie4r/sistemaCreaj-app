<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/login.php");

entrar();

//variables
$consulta = new Query; //Crear una consulta
$rolActivo = $_SESSION['rol'];
$nombre = $_POST["nombre"];
$materia = $_POST["materia"];
$grado = $_POST["grado"];

switch ($rolActivo) {
    case 'i':
        //
        break;
    
    default:

        if( empty($materia) && empty($grado) ){
            $proyectos = $consulta->searchProyectsByName($nombre);
        }else if( empty($materia) && !empty($grado) ){
            $proyectos = $consulta->searchProyectsByNameAndGrade($nombre, $grado);
        }else if( empty($grado) && !empty($materia) ){
            $proyectos = $consulta->searchProyectsByNameAndMatter($nombre, $materia);
        }else{
            $proyectos = $consulta->searchProyectsByNameAndMatterAndGrade($nombre, $grado, $materia);
        }

    break;
}

if(!empty($proyectos)){
    for ($i=0; $i < count($proyectos); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-6'>" . $proyectos[$i]["nombreProyecto"] . "</td>";
        echo "\t<td class='p-6'>" . $proyectos[$i]["descripcion"] . "</td>";
        echo "\t<td class='p-6'><a href='editProjects.php?idproject=" . $proyectos[$i]["idproyecto"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Ver</a></td>";
        echo "\t<td class='p-6'><a href='deleteProjects.php?idequipo=" . $proyectos[$i]["idproyecto"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
        echo "</tr>";
    }
    echo "k";
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay ningun proyecto con ese filtro.<td>";
    echo "</tr>";
}

?>