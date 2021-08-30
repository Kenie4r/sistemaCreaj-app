<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$Proyecto = $consulta->getProject(); //Get Estudiantes

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="button.js"></script>
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
                <h1 class="text-5xl text-gray-500">Proyectos</h1>
            </div>
            <div class="flex lg:justify-end">
                <a href="newProjects.php" class="text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class="icon-plus"></span> Nuevo proyecto</a>
            </div>
        </div>
        <?php
if(!empty($Proyecto)){
    echo "<div class='flex flex-row items-center m-7'>";
    echo "\t<div class=''>";
    echo "\t<input type='text' name='txtBusquedaId' id='txtBusquedaId' class='p-1 border-gray-700 border-solid border-2 rounded-lg outline-none' placeholder='Buscar por ID...'>";
    echo "\t</div>";
    echo "</div>";
}
?>

        <div class="box-border m-7">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="rounded-tl-lg p-4">ID</td>
                        <td class="p-4">Nombre</td>
                        <td class="p-4">Descripción</td>
                        <td colspan="3" class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body-rubrica" class="bg-gray-200">
                <?php

if(!empty($Proyecto)){
    for ($i=0; $i < count($Proyecto); $i++) { 
        echo "<tr class='lol'>";
    echo "\t<td class='p-6'>" . $Proyecto[$i]["idproyecto"] . "</td>";
    echo "\t<td class='p-6'>" . $Proyecto[$i]["nombreProyecto"] . "</td>";
    echo "\t<td class='p-6'>" . $Proyecto[$i]["descripcion"] . "</td>";
    echo "\t<td class='p-6'><a href='?idrubric=" . $Proyecto[$i]["idproyecto"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
    echo "\t<td class='p-6'><a href='deleteProjects.php?idequipo=" . $Proyecto[$i]["idproyecto"] . "' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
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