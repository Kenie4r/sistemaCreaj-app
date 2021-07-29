<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$grado=$_POST['grado'];
$seccion=$_POST['seccion'];
$nivel=$_POST['nivel'];
            if (isset($_POST['grado'])) {
                $consulta=new Query;
                //$nivel=$_POST['nivel'];
                //$materia=$_POST['materia'];
                //$guardarNom=$consulta->saveNivel($nivel);
                $guardarGrado=$consulta->saveGrado($grado,$seccion,$nivel);
                echo "Dato guardado "."grado: ".$grado. " seccion ". $seccion." nivel ".$nivel;
            }else {
                echo "no se pudo guardar";
            }
      ?>