<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/soporteEscribirAcademico.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Proyectos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../plugin_JS/chosen_JQuery/chosen.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <script src="../plugin_JS/chosen_JQuery/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../js/script-Projects.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body >
<?php
require('../Dashboard/Dashboard.php');

$username = $_SESSION['usario'];

?>

      <article class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-500">Proyectos</h1>
            </div>
<?php
if($_SESSION['rol'] == 'a' || $_SESSION['rol'] == 'c'){
?>
            <div class="flex lg:justify-end">
                <a href="newProjects.php" class="text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class="icon-plus"></span> Nuevo proyecto</a>
            </div>
<?php
}
?>
        </div>
      <div class='flex flex-col lg:flex-row gap-2 m-7'>
            <div class='flex flex-row'>
                <input type='text' name='txtBusqueda' id='txtBusqueda' class='p-1 border-gray-700 border-solid border-2 rounded-tl-lg rounded-bl-lg  outline-none' placeholder='Buscar por...'>
                <label for="txtBusqueda" class="p-1 border-gray-700 border-solid border-2 rounded-tr-lg rounded-br-lg bg-gray-700 text-white outline-none">Nombre</label>
            </div>
            <div class="flex flex-row items-center  border-gray-700 border-solid border-2 rounded-lg">
                <label for="txtMateria" class="p-1 bg-gray-700 text-white">Materia</label>
                <select name="txtMateria" id="txtMateria" class="p-1 w-full rounded-r-lg chosen-select">
<?php writeMatter($username); ?>
                </select>
            </div>
            <div class="flex flex-row items-center border-gray-700 border-solid border-2 rounded-lg">
                <label for="txtNivel" class="p-1 bg-gray-700 text-white">Grado</label>
                <select name="txtNivel" id="txtNivel" class="p-1 w-full rounded-r-lg chosen-select">
<?php writeGrade($username); ?>
                </select>
            </div>
        </div>

        <div class="box-border m-7 overflow-scroll lg:overflow-hidden">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="p-4 rounded-tl-lg">Nombre</td>
                        <td class="p-4">Descripción</td>
                        <td colspan="3" class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body" class="bg-gray-200">
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