<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
    if (isset($_GET['id'])) {
       $id=$_GET['id'];
       $guardarNom=$consulta->updateGrado($id);
       echo "se pudo borrar";
    }else {
        echo "no se pudo borrar";
    }
?>