<?php 
    require('../../modelo/conection.php');
    require('../../modelo/query.php');
    require('../libs/htmlcreator.php');
    //obtenemos las variables que vamos a usar
    $grado = $_GET['idGrade']?$_GET['idGrade']:"";
    $materia = $_GET['idSubject']?$_GET['idSubject']:"";
    if(!($materia == "" &&  $grado == "") ){
        //instanciar el query 
        $query = new Query();
        $creator = new ranking();
        $creator-> header2();
        $creator->infoData($materia, $grado);




    }

?>