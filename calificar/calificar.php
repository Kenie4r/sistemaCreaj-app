<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/libs.php');
    require('../Dashboard/Dashboard.php');
    //definimos variables que se usaran en todo el documento
    $idRubric  = array();
    //Crea la primera parte del header, antes de leer los datos
    $htmlCreator= new html();

    //Con esta función creo el header y titulo del sitio web, no tiene ninguna interacción con la base de datos
    $htmlCreator->headerHTML();
    //con la siguiente función buscaremos la materia y grado, además de que nos escribira 
    //los datos del equipo, como descripción y también el nombre del equipo
   $idRubric =  $htmlCreator->getTeam($_GET['teamID'], $_SESSION['uid']);//nos ayudara a obtener los datos de para buscar la rúbrica
    $htmlCreator->writeRubric($idRubric[0], $idRubric[1]);
    $htmlCreator->endDocument();
?>