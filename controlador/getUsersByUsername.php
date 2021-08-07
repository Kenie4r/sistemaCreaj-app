<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$username = trim($_POST["nameuser"]);
$usuarios = $consulta->getUsersByUsername($username); //Get rúbricas by nombre and name

echo json_encode($usuarios);

?>