<?php
    #Todos los modelos requeridos para poder funcionar, además de integrar el libs
    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('../Dashboard/Dashboard.php');
    //creador de html 
    require('libs/htmlcreator.php');

    $create = new ranking();
    $create->header();
    $create->body();
    $create->generateGrades();


?>