<?php
    require("../modelo/conection.php");
    require("../modelo/query.php");
    //variable query
    $query = new Query();
    //variables de ID de materia y grado
    $grado = $_POST['idGrado']?$_POST['idGrado']:"";
    //usos de las variable query
    $html = "<div>$grado</div>";
    
    /*  $materias = $query->getSubjectByGradeP($grado);
    foreach($materias as $camp){
        
    }*/
    return $html;
?>