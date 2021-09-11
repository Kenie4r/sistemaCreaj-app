<?php
 require('../../modelo/conection.php');
 require('../../modelo/query.php');

 //instacia de querys
 $query = new Query();

 //variables para buscar el proyecto y la rúbrica
    $idProyecto = $_GET['proyecto']?$_GET['proyecto']:"";
    $idMateria = $_GET['materia']?$_GET['materia']:"";
    $idGrado  =$_GET['grado']?$_GET['grado']:"";
 
    if($idProyecto!="" && $idMateria!="" && $idGrado!=""){
           //primero se saca el idNivel para sacar la rúbrica 
        //ya teniendo los IDs de materia, grado y proyecto podemos buscarlo en una query
       // $gradoData = $query->getGradeById($idGrado);
        $teamData = $query->getTeamData($idProyecto);
        foreach($teamData as $campo){
            //escribimos los datos de cada uno del proyecto
            echo("<b>Nombre del proeycto: </b>" . $campo['nombreProyecto']);
            echo("<br/><b>Grado: </b>" . $campo['nombre'] ." " .$campo['seccion']);
            echo("<br/><b>Materia:</b> {$campo['nombreMateria']}");
            echo("<br/><b>Descripción del proyecto:</b> {$campo['descripcion']}");

            //escribir los estudiantes del equipo 
            $equipoData = $query-> obtainTeamMates($idProyecto);
            foreach($equipoData as $estudiante ){
                echo("<br/>" .  $estudiante['idestudiante']." ".$estudiante['apellidos']. " " .$estudiante['nombre']);
            }
            //escribir la nota promedio
            $notafinal = $query->getRankingbyID($idProyecto);
            echo("<br><b>Nota promedio: </b> {$notafinal['notafinal']}");
            echo("<br><h1>EVALUACIONES DE LOS JURADOS</h1>");

            //obtener todos los que calificaron
            $jurados = $query->getProjectsRateData($idProyecto);
            foreach($jurados as $jury){
                $infoPersonal  = $query->getUserById($jury['usuario_idUsuario']);
                echo("<br/><b>Nombre del jurado</b>: <br/>{$infoPersonal['apellidos']} {$infoPersonal['nombres']}");
                
            }


        }
    }

?>