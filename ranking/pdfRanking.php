<?php
require('../controlador/pdfRanking.php');

if(isset($_GET["idMateria"]) && isset($_GET["idGrado"])){
    if(empty($_GET["idMateria"]) && empty($_GET["idGrado"])){
        emptyRankingProyecto();
    }else{
        //Imprime el pdf
        $materia = $_GET["idMateria"];
        $grado = $_GET["idGrado"];
        rankingProyecto($materia, $grado);
    }
}else{
    emptyRankingProyecto();
}

?>