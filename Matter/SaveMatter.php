<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
            if (isset($_POST['materia'])) {
                $consulta=new Query;
                //$nivel=$_POST['nivel'];
                $materia=$_POST['materia'];
                //$guardarNom=$consulta->saveNivel($nivel);
                $guardarMat=$consulta->saveMateria($materia);
                echo "Dato guardado ";
            }else {
                echo "no se pudo guardar";
            }
      ?>