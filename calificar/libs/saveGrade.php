<?php
    require('../../modelo/conection.php');
    require('../../modelo/query.php');
//Instanción de la variable Query
    $query = new Query();
    //Definición de las variables
    $notaFinal = $_POST['finalGrade']?$_POST['finalGrade']:"";
    $idTeam = $_POST['txtIdTeam']?$_POST['txtIdTeam']:"";
    $userID = $_POST['txtuserID']?$_POST['txtuserID']:"";
    $materia =$_POST['subjecttxt']?$_POST['txtuserID']:"";
    $grado = $_POST['levelttxt']?$_POST['txtuserID']:"";
    $result = $query->savePuntaje($idTeam, $userID, $notaFinal);
    if($result =="Registro hecho"){
       $counted = $query->getCountRatedProject($idTeam);
       if($counted['COUNT(*)']>1){
           $grade = 0;
           $allRates = $query-> getRatedsProject($idTeam);
           foreach($allRates as $camp){
               $grade +=$camp['puntaje'];
           }
           $grade/=$counted['COUNT(*)'];
           $ranked = $query-> updateRanking($idTeam, $grade);
       }else{
            $grade =$notaFinal;
            $ranked= $query-> saveRank($idTeam, $materia, $grado,$grade);
       }
       print($ranked);
        header('Location: http://creaj21/calificar/index.php');

    }else{

    }
?>