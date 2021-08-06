<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$usuario = $consulta->getUserByUsername($_POST["username"]); //Get rúbricas by nombre and name
$contra = trim($_POST["contra"]);
$contra = md5($contra);

if($usuario["password"] == $contra){
    echo "1";
}else{
    echo "0";
}

?>