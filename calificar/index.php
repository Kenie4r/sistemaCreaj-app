<?php

    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/libs.php');
    require_once("../parameters/soporteParametros.php");
    comparacionFecha("Limite de calificacion");
    //vamos a crear un nuevo html usando la clase creada para esto, llamada html
    $htmlCreator= new html();
    $htmlCreator->watchProjects( );
    require('../Dashboard/Dashboard.php');

    $htmlCreator->theresProjects($_SESSION['uid']);

?>