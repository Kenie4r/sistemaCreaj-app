<?php

//Declarar la funcion para calcular el ID de las rubricas
function newIDRubric(){
    $yearActual = date("Y"); //Año actual
    $nRubricas = nextNRubric($yearActual); //Siguiente número correlativo de rúbrica
    $id = "";

    if($nRubricas < 10){
        $id = $yearActual . "-00" . $nRubricas;
    }else if($nRubricas < 100){
        $id = $yearActual . "-0" . $nRubricas;
    }else{
        $id = $yearActual . "-" . $nRubricas;
    }

    return $id;
}

function nextNRubric($yearActual){
    $consulta = new Query; //Crear una consulta
    $rubricas = $consulta->getEndRubric($yearActual); //Get ID rúbrica ultimo
    $nRubricas = 0;

    if(!empty($rubricas)){
        $rubricas = $rubricas[0]["idrubrica"];
        $rubricas = explode("-",$rubricas);
        $nRubricas = intval($rubricas[1]) + 1;
    }else{
        $nRubricas = 0;
    }

    return $nRubricas;
}

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
function writeGradeForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $grados = $consulta->getGrade(); //Get niveles

    if(empty($grados)){
        echo "<option value=''>No hay grados para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un grado para asignar...</option>\n";
        foreach ($grados as $key => $grado) {
            echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . " " . $grado["seccion"] . "</option>\n";
        }
    }
}

//Declarar la funcion para escribir los niveles para la siguiente rubrica
function writeLevelForNewRubric(){
    $consulta = new Query; //Crear una consulta
    $niveles = $consulta->getLevel(); //Get niveles

    if(empty($niveles)){
        echo "<option value=''>No hay niveles para elegir</option>\n";
    }else{
        echo "<option value=''>Elige un nivel para asignar...</option>\n";
        foreach ($niveles as $key => $nivel) {
            echo "<option value='" . $nivel["idnivel"] . "'>" . $nivel["nombre"] . "</option>\n";
        }
    }
}

?>