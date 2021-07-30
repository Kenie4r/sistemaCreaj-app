<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/login.php");

$consulta = new Query; //Crear una consulta
$rubricas = $consulta->getRubrics(); //Get rúbricas

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-rubric.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <article class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-500">Rúbricas</h1>
            </div>
        </div>
<?php
/*if(!empty($rubricas)){
    echo "<div class='flex flex-row items-center m-7'>";
    echo "\t<div class=''>";
    echo "\t<input type='text' name='txtBusquedaId' id='txtBusquedaId' class='p-1 border-gray-700 border-solid border-2 rounded-lg outline-none' placeholder='Buscar por ID...'>";
    echo "\t</div>";
    echo "</div>";
}*/
?>
        <div class="box-border m-7">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="rounded-tl-lg p-4">ID</td>
                        <td class="p-4">Nombre</td>
                        <td class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body-rubrica" class="bg-gray-200">
<?php

if(!empty($rubricas)){
    for ($i=0; $i < count($rubricas); $i++) { 
        echo "<tr class='lol'>";
    echo "\t<td class='p-4'>" . $rubricas[$i]["idrubrica"] . "</td>";
    echo "\t<td class='p-4'>" . $rubricas[$i]["nombre"] . "</td>";
    echo "\t<td class='p-4'><a href='rubric.php?idrubric=" . $rubricas[$i]["idrubrica"] . "' class='hover:text-blue-900'><span class='icon-eye'></span> Ver</a></td>";
    echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='3' class='p-4'><span class='icon-blocked'></span> No hay rubricas en el sistema<td>";
    echo "</tr>";
}

?>
                </tbody>
                <tfoot class="bg-gray-900">
                    <tr>
                        <td colspan="5" class="rounded-b-lg p-2"> </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </article>
</body>
</html>