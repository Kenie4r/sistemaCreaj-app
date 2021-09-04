<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("index.php");

$consulta = new Query; //Crear una consulta


//Obtenemos el ID de los parametros para poder 
$nombre= $_POST["nombre"];
$IDparametros = $consulta->getIDparametros($nombre);

//Obtener los nombres de las fechas y modificarlos
$idparametros= $_POST['idparametros'];
$paramFecha = $_POST["txtinicio"];
$paramFechaF = $_POST["txtfin"];
$fechas =  $consulta->updataParametros($idparametros, $paramFecha, $paramFechaF);