<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

//CONSULTA
$consulta = new Query;

//VARIBALES GLOBALES
$filtroTipo = $_POST["tipo"];
$filtro = $_POST["filtro"];
$filtroGrado = $_POST["grado"];
$resultados = 0;

//SE OBTIENEN LAS RUBRICAS SEGUN EL FILTRO
if( $filtroTipo == "id"){
    $estudiantes = $consulta->searchAlumnosById($filtro); //Get estudiantes by id
}else{
    $estudiantes = $consulta->searchEstudiantesByName($filtro); //Get estudiantes by nombre
}

//SE LLENA LA TABLA
if(!empty($estudiantes)){
    //Se recorre el array de estudiantes
    for ($i=0; $i < count($estudiantes); $i++) {
        //Variables
        $estudiante = $estudiantes[$i];
        $grado = $estudiantes[$i]["grado_idgrado"];
        
        //Se llena la tabla aplicando los filtros
        if( !empty($filtroGrado) ){
            //Se aplica el filtro de grado
            if( $filtroGrado == $grado ){
                escribirFila($estudiante);
                $resultados++;
            }
        }else{
            //No se aplica ningun filtro
            escribirFila($estudiante);
            $resultados++;
        }

    }
    
    //Si no hay resultados se escribe que no hay estudiantes
    if( $resultados == 0 ){
        escribirFilaEmpty();
    }
}else{
    //Se escribe que no hay estudiantes
   escribirFilaEmpty();
}

//Sin resultados
function escribirFilaEmpty() {
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay coincidencias.<td>";
    echo "</tr>";
}

//Se escribi una fila con los datos de un estudiante
function escribirFila($estudiante) {
    echo "<tr class='lol'>";
    echo "\t<td class='p-6'>" . $estudiante["idestudiante"] . "</td>";
    echo "\t<td class='p-6'>" . $estudiante["nombre"] . "</td>";
    echo "\t<td class='p-6'>" . $estudiante["apellidos"] . "</td>";
    echo "\t<td class='p-6'><a href='editStudents.php?student=" . $estudiante["idestudiante"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
    echo "\t<td class='p-6'><a href='deleteStudents.php?student=" . $estudiante["idestudiante"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
    echo "</tr>";
}

?>