<?php
    #Todos los modelos requeridos para poder funcionar, además de integrar el libs
    require('../modelo/conection.php');
    require('../modelo/query.php');
    //creador de html 
    require('libs/htmlcreator.php');

    $create = new ranking();
    $create->header();
    require('../Dashboard/Dashboard.php');
    $create->body();
    $create->generateGrades($_SESSION['rol'], $_SESSION['uid']);
    $create->creatematerias();

?>