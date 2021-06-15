<?php

require_once("modelo/conection.php");
require_once("modelo/query.php");

$consulta = new Consultas;

$usuarios = $consulta->getUsers();

echo count($usuarios);

?>