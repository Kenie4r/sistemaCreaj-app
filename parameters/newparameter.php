<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Nuevo Parámetros</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newRubric.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
 <form id="frmRubric" class="container box-content" method="POST" action="saveparameter.php">
    <h1 class="text-center w-3/4 lg:w-full lg:text-5xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Agregar parámetro</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 ml-24">
            <div class="flex lg:m-9">
                <div class="lg:m-2">
                <a href="" id="btnSubmit" class=" block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span><input type="submit" value="Guardar"> </a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9 ml-36">
                <div class=" "> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="0-txtinicio" class="w-60 p-2 bg-gray-700 text-white">Fecha de inicio</label>
                        <input class="p-1 w-full rounded-r-lg outline-none" type="date" name="0-txtFechaInicio" value="" >
                    </div>
               </div>
                <div class="mt-10"> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="0-txtfin" class="w-60 p-2 bg-gray-700 text-white">Fecha de cierre</label>
                        <input class="p-1 w-full rounded-r-lg outline-none" type="date" name="0-txtFechaFin" value="" >
                   </div>
               </div>
        </div>
    </form>
</body>
</html>
             