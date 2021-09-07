<?php
//Declarar la funcion para escribir los alumnos en los proyectos
function writeAlumnosForNewProjects(){
    $consulta = new Query; //Crear una consulta
    $alumnos= $consulta->getAlumnosByGrados(); //Get alumnos
    if(empty($alumnos)){
        while ($a = $alumnos->fetch_assoc) {
            echo "<option value=''>Elige los alumnos para asignar...</option>\n";
            echo "<option value='".$a['idestudiante']."'>" .$a['nombre'].  $a['apellidos']. "</option>";
        }
    }

}
?>