<?php

//Declarar la funcion para escribir las materias para la nueva rubrica
function writeMatter($username){
    $consulta = new Query; //Crear una consulta
    $materias = array();
    $auxiliar = 0;
    
    $asignacionesUsuario = obtenerAsignacionPorRol($username); //Obtenemos las asignaciones de este jurado

    if(empty($asignacionesUsuario)){
        $materias = $consulta->getMatter(); //Obtener todas las materias
    }else{
        foreach ($asignacionesUsuario as $key => $asignacion) {
            if($auxiliar != $asignacion['materia_idmateria']){
                $materias[] = $consulta->getMatterById($asignacion['materia_idmateria']); //Obtener materias segun sus asignaciones
            }
            $auxiliar = $asignacion['materia_idmateria'];
        }
    }

    if(empty($materias)){
        echo "<option value=''>No hay materias para buscar</option>\n";
    }else{
        if(empty($asignacion)){
            echo "<option value=''>Elige una materia para buscar...</option>\n";
        }
        foreach ($materias as $key => $materia) {
            echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
        }
    }
}

//Declarar la funcion para escribir los niveles para la siguiente rubrica
function writeGrade($username){
    $consulta = new Query; //Crear una consulta
    $grados = array();
    $auxiliar = 0;

    $asignacionesUsuario = obtenerAsignacionPorRol($username); //Obtenemos las asignaciones de este jurado

    if(empty($asignacionesUsuario)){
        $grados = $consulta->getGrade(); //Obtener todos niveles
    }else{
        foreach ($asignacionesUsuario as $key => $asignacion) {
            if($auxiliar != $asignacion['grado_idgrado']){
                $grados[] = $consulta->getOneGradeById3($asignacion['grado_idgrado']); //Obtener materias segun sus asignaciones
            }
            $auxiliar = $asignacion['grado_idgrado'];
        }
    }

    if(empty($grados)){
        echo "<option value=''>No hay grados para buscar</option>\n";
    }else{
        if(empty($asignacionesUsuario)){
            echo "<option value=''>Elige un grado para buscar...</option>\n";
        }
        foreach ($grados as $key => $grado) {
            echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . " " . $grado["seccion"] . "</option>\n";
        }
    }
}

//Declarar la funcion para escribir los niveles para la siguiente rubrica
function writeLevel(){
    $consulta = new Query; //Crear una consulta
    $niveles = $consulta->getLevel(); //Get niveles

    if(empty($niveles)){
        echo "<option value=''>No hay niveles para buscar</option>\n";
    }else{
        echo "<option value=''>Elige un nivel para buscar...</option>\n";
        foreach ($niveles as $key => $nivel) {
            echo "<option value='" . $nivel["idnivel"] . "'>" . $nivel["nombre"] . "</option>\n";
        }
    }
}

function obtenerAsignacionPorRol($username){
    $consulta = new Query; //Crear una consulta
    $usuario = $consulta->getUserByUsername($username);
    $iduser = $usuario['idUsuario'];
    $asignacionesUsuario = $consulta->getProjectsinfo($iduser); //Obtenemos las asignaciones de este jurado

    return $asignacionesUsuario;
}

?>