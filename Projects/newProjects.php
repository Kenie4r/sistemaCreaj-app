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
    <title>Crea J | Nueva rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newRubric.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <form id="frmNewRubric" class="container box-content" method="POST" action="saveRubric.php">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex flex-row items-center m-9 text-gray-500 text-3xl">
                <input class="w-3/4 lg:w-full lg:text-5xl outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtNombreRubrica" id="txtNombreRubrica" value="Nuevo proyecto" maxlength="45" required>
                <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
            </div>
            <div class="flex lg:justify-end ml-9 lg:m-9">
                <div class="lg:m-2">
                    <a href="#" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9">
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtID" class="p-2 bg-gray-700 text-white">ID</label>
                    <input type="text" name="txtID" id="txtID" value="" class="p-1 w-full rounded-r-lg outline-none" readonly>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="p-2 bg-gray-700 text-white">Materia</label>
                    <select name="txtMateria" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">
<?php

if(empty($materias)){
    echo "<option value=''>No hay materias para elegir</option>\n";
}else{
    echo "<option value=''>Elige una materia para asignar...</option>\n";
    foreach ($materias as $key => $materia) {
        echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
    }
}

?>
                    </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                                        <label for="txtNivel" class="p-2 bg-gray-700 text-white">Nivel</label>
                                        <select name="txtNivel" id="txtNivel" class="p-1 w-full rounded-r-lg outline-none">
 <?php

if(empty($materias)){
    echo "<option value=''>No hay niveles para elegir</option>\n";
}else{
    echo "<option value=''>Elige un nivel para asignar...</option>\n";
    foreach ($niveles as $key => $nivel) {
        echo "<option value='" . $nivel["idnivel"] . "'>" . $nivel["nombre"] . "</option>\n";
    }
}

?>

</select>
                </div>
            </div>
            <div class="mt-10 ">
                <div class="flex flex-row items-center mb-10 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtID" class="p-2 bg-gray-700 text-white">Descripcion</label>
                    <input type="text" name="txtID" id="txtID" value="" class="rounded-r-lg" readonly>
                </div>
            </div>
            
        </div>
