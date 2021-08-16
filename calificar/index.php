<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/libs.php');
    require('../Dashboard/Dashboard.php');
    //vamos a crear un nuevo html usando la clase creada para esto, llamada html
    $htmlCreator= new html();
    $htmlCreator->watchProjects( );
    $htmlCreator->theresProjects($_SESSION['uid']);

?>