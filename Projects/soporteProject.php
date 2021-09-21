<?php

//Declarar la funcion para escribir las materias para el nuevo proyecto
function writeMatterForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $materias = $consulta->getMatter(); //Get materias

    if(empty($materias)){
        echo "<option value=''>No hay materias para elegir</option>\n";
    }else{
        echo "<option value=''>Elige una materia para asignar...</option>\n";
        foreach ($materias as $key => $materia) {
            echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
        }
    }
}

//Declarar la funcion para escribir los niveles para la siguiente proyecto
function writeLevelForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $grados = $consulta->getGrado(); //Get niveles

    if(empty($grados)){
        echo "<option value=''>No hay Grados para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un Grado para asignar...</option>\n";
        foreach ($grados as $key => $grado) {
            echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . " " . $grado["seccion"] . "</option>\n";
        }
    }
}

?>