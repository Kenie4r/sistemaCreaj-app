<?php
    require('../../modelo/conection.php');
    require('../../modelo/query.php');
//Instanción de la variable Query
    $query = new Query();
    //Definición de las variables
    $notaFinal = $_POST['finalGrade']?$_POST['finalGrade']:"";
    $idTeam = $_POST['txtIdTeam']?$_POST['txtIdTeam']:"";
    $userID = $_POST['txtuserID']?$_POST['txtuserID']:"";
    echo($userID);
    $result = $query->savePuntaje($idTeam, $userID, $notaFinal);
    if($result =="Registro hecho"){
        header('Location: http://creaj21/calificar/index.php');
    }else{

    }
?>