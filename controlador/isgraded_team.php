<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    $query = new Query();
    $idTeam = $_POST['teamID'];
    $userID = $_POST['userID'];
    $contador = $query->isSavedProject($idTeam, $userID);
    foreach($contador as $camps){
        foreach($camp as $c){
            $graded = $c;
        }
    }
    if($graded>0){
        return false;
    }else{
        return true;
    }
?>