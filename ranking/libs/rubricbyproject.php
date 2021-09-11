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
                //obtenemos la infotmación del usuario como nombres y apellidos
                $infoPersonal  = $query->getUserById($jury['usuario_idUsuario']);
                echo("<br/><b>Nombre del jurado</b>: <br/>{$infoPersonal['apellidos']} {$infoPersonal['nombres']}");
                //luego en la tabla puntos sacamos aquellos que son del usuario y le pertenecen al proyecto
                $criteriosC = $query->getPointsbyUserandTeam($jury['usuario_idUsuario'], $idProyecto);
                
                foreach($criteriosC as $criterio){
                    //por cada uno vamos a obtener los datos 
                   $criterioInfo = $query->getCriterioByID($criterio['criterios_idcriterios']);
                   echo("<br/>" . $criterioInfo['titulo'] . " {$criterioInfo['puntaje']} PUNTOS");
                   if($criterio['puntos']<=69){
                    $nivel = "Inicial receptivo";
                   }else if($criterio['puntos']>69 && $criterio['puntos']<80 ){
                    $nivel = "Básico";
                   }else if($criterio['puntos']>79 && $criterio['puntos']<90){
                    $nivel = "Autonómo";
                   }else{   
                    $nivel = "Estratégico";
                   }
                   $naprobacion = $query-> getRange($criterio['criterios_idcriterios'], $nivel);
            
                   echo("<br/> Nivel obtenido: " . $naprobacion['rango']." : " . round($criterio['puntos'], 2));
                   echo("<br/>Descripción: " .$naprobacion['descripcion']);
                }

                echo('<br/>Nota final: ' . $jury['puntaje']);
            }


        }
    }

?>