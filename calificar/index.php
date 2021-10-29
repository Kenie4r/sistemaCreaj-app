<?php

    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/calificar_libs.php');
    require_once("../parameters/soporteParametros.php");
    comparacionFecha("Limite de calificacion");
    //vamos a crear un nuevo html usando la clase creada para esto, llamada html
    $htmlCreator= new htmlCreator();
    $htmlCreator->header();
    require('../Dashboard/Dashboard.php');
    $htmlCreator->CreateData($_SESSION['uid']);
    //$htmlCreator->theresProjects($_SESSION['uid']);

?>