<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$parametros = $consulta->getParametros(); //Get Estudiantes

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crea J | Parámetros</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../Dashboard/button.js"></script>
</head>
<body >
    <?php
         require('../Dashboard/Dashboard.php');
         require_once("../modelo/conection.php");
         require_once("../modelo/query.php");
         
    ?>
      <article class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-500">Parametros</h1>
            </div>
        </div>

        <div class="box-border m-7 mt-20">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="rounded-tl-lg p-4">ID</td>
                        <td class="p-4">Nombre</td>
                        <td class="p-4">Fecha de inicio</td>
                        <td class="p-4">Fecha de cierre</td>
                        <td colspan="3" class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body-rubrica" class="bg-gray-200">
                <?php

if(!empty($parametros)){
    for ($i=0; $i < count($parametros); $i++) { 
        echo "<tr class='lol'>";
    echo "\t<td class='p-6'>" . $parametros[$i]["idparametros"] . "</td>";
    echo "\t<td class='p-6'>" . $parametros[$i]["nombre"] . "</td>";
    echo "\t<td class='p-6'>" . $parametros[$i]["paramFecha"] . "</td>";
    echo "\t<td class='p-6'>" . $parametros[$i]["paramFechaF"] . "</td>";
    echo "\t<td class='p-4'><a href='editParameters.php?idparam=" . $parametros[$i]["idparametros"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
    echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay proyectos  en el sistema<td>";
    echo "</tr>";
}

?>
  </tbody>
                <tfoot class="bg-gray-900">
                    <tr>
                        <td colspan="6" class="rounded-b-lg p-2"> </td>
                    </tr>
                </tfoot>
                </table>
        </div>
    </article>
</body>
</html> 