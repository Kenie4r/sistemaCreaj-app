<?php
require('../controlador/pdfEvaluacionesProyectos.php');

if(isset($_GET['proyecto']) && !(empty($_GET['proyecto']))){
    evaluacionProyecto($_GET['proyecto']);
}else{
    emptyEvaluacionProyecto();
}

?>