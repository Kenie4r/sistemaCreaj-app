<?php
require('../controlador/pdfRanking.php');

if(isset($_GET["idSubject"]) && isset($_GET["idGrade"])){
    if(empty($_GET["idSubject"]) && empty($_GET["idGrade"])){
        emptyRankingProyecto();
    }else{
        //Imprime el pdf
        $materia = $_GET["idSubject"];
        $grado = $_GET["idGrade"];
        rankingProyecto($materia, $grado);
    }
}else{
    emptyRankingProyecto();
}

?>