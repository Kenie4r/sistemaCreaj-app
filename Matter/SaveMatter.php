<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta=new Query;


            if (isset($_POST['materia'])) {
                //$nivel=$_POST['nivel'];
                $materia=ucfirst($_POST['materia']);
                //$guardarNom=$consulta->saveNivel($nivel);
                //$guardarMat=$consulta->saveMateria($materia);
                echo "Dato guardado ";
            }else {
                echo "no se pudo guardar";
            }
      ?>
