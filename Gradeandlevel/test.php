
<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query;
$opc=$consulta->getLevel();
$Nlev=count($opc);
if (isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];
    foreach ($opc as $nivel) {
        if (strpos($nivel,$nombre!==false)) {
            echo $nivel;
        }
    }
}
?>