<?php
//Declarar la funcion para escribir los alumnos en los proyectos
    $consulta = new Query; //Crear una consulta
    $grado_idgrado=$_POST['grados'];
    $alumnos= $consulta->getAlumnosByGrados($grado_idgrado); //Get alumnos
    if(empty($alumnos)){
        $cadena=  "<option value=''>No hay alumnos para elegir</option>\n";
    }else{
         $cadena ="<option value=''>Elige los alumnos para asignar...</option>\n";
        while ($ver=mysqli_fetch_row($alumnos)) {
            
            $cadena= "<option value='".$ver['idestudiante']."'>" .$ver['nombre'].  $ver['apellidos']. "</option>";
        }
        echo $cadena;
    }

?>