<?php
require('../controlador/pdfEvaluacionesProyectos.php');

if(isset($_GET['proyecto']) && !(empty($_GET['proyecto']))){
    $consulta = new Query; //Crear una consulta
    $notaFinalProyecto = $consulta->getRankingbyID($_GET['proyecto']); //Promedio final
    if(empty($notaFinalProyecto)){
        infoProyecto($_GET['proyecto']);
    }else{
        evaluacionProyecto($_GET['proyecto']);
    }
}else{
    emptyEvaluacionProyecto();
    
}

?>