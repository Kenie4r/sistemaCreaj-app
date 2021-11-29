<?php

//Declarar la funcion para escribir las materias para la nueva rubrica
function writeMatter($materiaA = ""){
    $consulta = new Query; //Crear una consulta
    $materias = $consulta->getMatter(); //Get materias

    if(empty($materias)){
        echo "<option value=''>No hay materias para elegir</option>\n";
    }else{
        if(empty($materiaA)){
            echo "<option value=''>Elige una materia para asignar...</option>\n";
            foreach ($materias as $key => $materia) {
                echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
            }
        }else{
            foreach ($materias as $key => $materia) {
                if($materia["idmateria"] == $materiaA){
                    echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
                }
            }
            foreach ($materias as $key => $materia) {
                if($materia["idmateria"] != $materiaA){
                    echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
                }
            }
        }
    }
}

//Declarar la funcion para escribir los niveles para la siguiente rubrica
function writeGrade($gradoA = ""){
    $consulta = new Query; //Crear una consulta
    $grados = $consulta->getGrado(); //Get niveles

    if(empty($grados)){
        echo "<option value=''>No hay grados para elegir</option>\n";
    }else{
        if(empty($gradoA)){
            echo "<option value=''>Elige un grado para asignar...</option>\n";
            foreach ($grados as $key => $grado) {
                echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . "</option>\n";
            }
        }else{
            foreach ($grados as $key => $grado) {
                if($grado["idgrado"] == $gradoA){
                    echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . "</option>\n";
                }
            }
            foreach ($grados as $key => $grado) {
                if($grado["idgrado"] != $gradoA){
                    echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . "</option>\n";
                }
            }
        }
    }
}

?>