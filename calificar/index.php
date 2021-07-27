<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/libs.php');
    //Crea la primera parte del header, antes de leer los datos
    headerHTML();
    getTeam(2);

?>