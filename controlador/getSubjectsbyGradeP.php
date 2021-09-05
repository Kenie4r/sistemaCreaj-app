<?php
    require("../modelo/conection.php");
    require("../modelo/query.php");
    //variable query
    $query = new Query();
    //variables de ID de materia y grado
    $grado = $_POST['idGrado'];
    //usos de las variable query
    $html = "";
    $materias = $query->getSubjectByGradeP($grado);
    foreach($materias as $camps){
        foreach($camps as $a){
            //aquí a es el id de las materias por ello vamos a verificar si hay proyectos ya calificados con los dos datos ya obtenidos
            $ngraded = $query-> getCountRatedPbyIDs($grado, $a);
            if($ngraded['COUNT(*)']>0){
                $materia = $query->getMatterById($a);
                $html .= "
                <div class='bg-white w-full shadow-xl p-2 flex flex-row justify-between my-3'>
                <div class='text-center'>
                    <h1 class='text-2xl'>{$materia['nombre']}</h1>
                </div>
                <!--Un botón para seleccionar al grado-->
                <div>
                    <div >
                        <a target='_blank' href='rank/rank.php?idSubject={$a}&idGrade={$grado}' class='button p-2 border border-2 bg-indigo-600 text-white cursor-pointer btnGrade' id='btn-{$a}'>
                         Ver ranking
                        </a>
                    </div>
                </div>
                </div>
                ";
            }

        }
    }
   print($html)
?>