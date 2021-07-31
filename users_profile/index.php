<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

//Verificar session

$consulta = new Query; //Crear una consulta
$usuarios = $consulta->getUsers(); //Obtener usuarios

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Usuarios</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-profile.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <article class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-500">Usuarios</h1>
            </div>
            <div class="flex lg:justify-end">
                <a href="newProfile.php" class="text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class="icon-plus"></span> Nuevo Usuario</a>
            </div>
        </div>
<?php
if(!empty($usuarios)){
    echo "<div class='flex flex-row items-center m-7'>";
    echo "\t<div class=''>";
    echo "\t<input type='text' name='txtBusquedaName' id='txtBusquedaName' class='p-1 border-gray-700 border-solid border-2 rounded-lg outline-none' placeholder='Buscar por nombre de usuario...'>";
    echo "\t</div>";
    echo "</div>";
}
?>
        <div class="box-border m-7">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="rounded-tl-lg p-4">Usuario</td>
                        <td class="p-4">Nombre</td>
                        <td class="p-4">Apellido</td>
                        <td class="p-4">Rol</td>
                        <td class="p-4">Email</td>
                        <td colspan="3" class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body-rubrica" class="bg-gray-200">
<?php

if(!empty($usuarios)){
    for ($i=0; $i < count($usuarios); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-4'>" . $usuarios[$i]["usario"] . "</td>";
        echo "\t<td class='p-4'>" . $usuarios[$i]["nombres"] . "</td>";
        echo "\t<td class='p-4'>" . $usuarios[$i]["apellidos"] . "</td>";
        echo "\t<td class='p-4'>" . $usuarios[$i]["rol"] . "</td>";
        echo "\t<td class='p-4'>" . $usuarios[$i]["email"] . "</td>";
        echo "\t<td class='p-4'><a href='#' class='hover:text-blue-900'><span class='icon-eye'></span> Ver</a></td>";
        echo "\t<td class='p-4'><a href='#' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
        echo "\t<td class='p-4'><a href='deleteRubric.php?idrubric=variable' class='hover:text-blue-900 btn-delete'><span class='icon-cross'></span> Eliminar</a></td>";
        echo "</tr>";
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='8' class='p-4'><span class='icon-blocked'></span> No hay usuarios en el sistema</td>";
    echo "</tr>";
}

?>
                </tbody>
                <tfoot class="bg-gray-900">
                    <tr>
                        <td colspan="8" class="rounded-b-lg p-2"> </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </article>
</body>
</html>