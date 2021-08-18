<?php

//Declarar la funcion para escribir las materias para la nueva rubrica
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

//Declarar la funcion para escribir los niveles para la siguiente rubrica
function writeLevelForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $grados = $consulta->getGrado(); //Get niveles

    if(empty($grados)){
        echo "<option value=''>No hay niveles para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un nivel para asignar...</option>\n";
        foreach ($grados as $key => $nivel) {
            echo "<option value='" . $nivel["idgrado"] . "'>" . $nivel["nombre"] . "</option>\n";
        }
    }
}

?>