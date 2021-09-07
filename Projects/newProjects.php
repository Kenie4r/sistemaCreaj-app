<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("soporteProject.php");
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
    <script src="StudentsGrade.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
require_once("../parameters/soporteParametros.php");
comparacionFecha("Ingreso de proyectos");
?>
 <form id="frmRubric" class="container box-content" method="POST" action="saveProjects.php">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex flex-col m-9">
                <div class="flex flex-row items-center text-gray-500 text-3xl">
                    <div id="ctNR" class="flex flex-row items-center content-center border-b-2 border-solid border-green-700">
                        <input class="w-3/4 lg:w-full lg:text-5xl outline-none" type="text" name="txtNombre"  value="Nuevo proyecto" maxlength="45" required>
                    </div>
                    <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
                    <input type="checkbox" name="ckbNameValidate" id="ckbNameValidate" class="hidden" disabled>
                </div>
                <div>
                    <p class="text-green-700" id="lbMensajeNR">Nombre válido</p>
                </div>
            </div>
            <div class="flex lg:justify-end ml-9 lg:m-9">
                <div class="lg:m-2">
                <a href="" id="btnSubmit" class=" block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span><input type="submit" value="Guardar"> </a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9">
          
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="p-2 bg-gray-700 text-white">Materia</label>
                    <select name="txtMateria" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">
<?php writeMatterForNewRubric(); ?>
                    </select>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Grado</label>
                    <select name="txtNivel" id="txtNivel" class="p-1 w-full rounded-r-lg outline-none">
<?php writeLevelForNewRubric(); ?>
                    </select>
                </div>
            </div>

            <div class=" "> 
                    <div class="mt-10  flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Descripcion</label>
                        <input class="w-1/4	 lg:w-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtDescripcion" value="" >
                        <label for="txtNombreRubrica" title="Editar" ><span class="hidden lg:block icon-pencil"></span></label>
                    </div>
            </div>
            <div>
                <div class="my-10 flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Grado</label>
                    <select name="Alumnos[]" id="txtGrado" class="p-1 w-full rounded-r-lg outline-none" >
<?php writeLevelForNewRubric(); ?>
                    </select>
                </div>
            </div>
            <div>
                <div class="my-10 flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Alumnos</label>
                    <select name="Alumnos[]" id="txtAlumnos" class="p-1 w-full rounded-r-lg outline-none " multiple>
                    </select>
                </div>
            </div>
        </div>

    </form>
    
</body>
</html>
             