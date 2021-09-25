<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

//CONSULTA
$consulta = new Query;

//VARIABLES GLOBALES
$filtroTipo = $_POST["tiporubric"];
$filtro = $_POST["filtrorubric"];
$filtroMateria = $_POST["filtroMateria"];
$filtroGrado = $_POST["filtroGrado"];
$resultados = 0;

//BUSQUEDA SEGUN TIPO DE FILTRO
if($filtroTipo == "id"){
    $rubricas = $consulta->searchRubricById($filtro); //Get rúbricas by id
}else{
    $rubricas = $consulta->searchRubricByName($filtro); //Get rúbricas by nombre
}

//Se llena la tabla
if(!empty($rubricas)){
    //Se recorre el array de rubricas para escribir cada una en una fila
    for ($i=0; $i < count($rubricas); $i++) { 
        //VARIABLES
        $materia = $rubricas[$i]["materia_idmateria"];
        $grado = $rubricas[$i]["grado_idgrado"];
        $rubrica = $rubricas[$i];

        //Se filtran las rubricas
        if( !empty($filtroMateria) && !empty($filtroGrado) ){
            //Se aplican filtros de grado y materia
            if( $grado == $filtroGrado && $materia == $filtroMateria ){
                escribirFila($rubrica);
                $resultados++;
            }
        }else if( empty($filtroMateria) && !empty($filtroGrado) ){
            //Se aplica un filtro de grado
            if( $grado == $filtroGrado ){
                escribirFila($rubrica);
                $resultados++;
            }
        }else if( !empty($filtroMateria) && empty($filtroGrado) ){
            //Se aplica un filtro de materia
            if( $materia == $filtroMateria ){
                escribirFila($rubrica);
                $resultados++;
            }
        }else{
            //No se aplica ningun filtro
            escribirFila($rubrica);
            $resultados++;
        }
    }

    //Si no se escribio ningun resultado, despues del filtrado entonces se coloca un mensaje de vacio
    if( $resultados == 0 ){
        escribirEmpty();
    }

}else{
    //Si no hay rubricas, se coloca un mensaje de vacio
    escribirEmpty();
}

//Se escribe una fila con los datos de una rubrica
function escribirFila($rubricas) {
    echo "<tr class='lol'>";
    echo "\t<td class='p-4'>" . $rubricas["idrubrica"] . "</td>";
    echo "\t<td class='p-4'>" . $rubricas["nombre"] . "</td>";
    echo "\t<td class='p-4'><a href='rubric.php?idrubric=" . $rubricas["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-eye'></span> Ver</a></td>";
    echo "\t<td class='p-4'><a href='reutilizarRubrica.php?idrubric=" . $rubricas["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-copy'></span> Reutilizar</a></td>";
    echo "\t<td class='p-4'><a href='editRubric.php?idrubric=" . $rubricas["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
    echo "\t<td class='p-4'><a href='deleteRubric.php?idrubric=" . $rubricas["idrubrica"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
    echo "</tr>";
}

//Se escribe una fila de 0 resultado
function escribirEmpty() {
    echo "<tr class='lol'>";
    echo "\t<td colspan='6' class='p-4'><span class='icon-blocked'></span> Sin resultados.<td>";
    echo "</tr>";
}

?>