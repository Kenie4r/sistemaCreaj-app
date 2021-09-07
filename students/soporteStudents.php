<?php

//Declarar la funcion para escribir las materias para la nueva rubrica
function writeproject(){
    $consulta = new Query; //Crear una consulta
    $project = $consulta->getProject(); //Get materias

    if(empty($project)){
        echo "<option value=''>No hay proyectos para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un proyecto para asignar...</option>\n";
        foreach ($project as $key => $project) {
            echo "<option value='" . $project["idproyecto"] . "'>" . $project["nombreProyecto"] . "</option>\n";
        }
    }
}

function writeLevelForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $grados = $consulta->getGrado(); //Get niveles

    if(empty($grados)){
        echo "<option value=''>No hay Grados para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un Grado para asignar...</option>\n";
        foreach ($grados as $key => $grado) {
            echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . "</option>\n";
        }
    }
}
?>