<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("soporteStudents.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Subir por excel</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="../../Dashboard/button.js"></script>
</head>
<body class="bg-">
<?php
require('../Dashboard/Dashboard.php');  
?>
    <section>
    <h1 class="text-center w-3/4 lg:w-full lg:text-5xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Agregar estudiante por excel</h1>
        
        <div class="mx-60 mt-10 ">
            <p class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 "><b>Aviso:</b> Acontinuación se muestra un modo de subir datos mucho más fácil, para ello es necesario un documento excel,
             este es funcional desde Excel 2007, además es necesario usar un molde especifico para poder usar este tipo de guardado.</p>
        </div>
            <div class=" text-center	">
                <a href="base.xlsx">
                    <div class="mx-60 mr-96 mt-10">
                        <p class="mr-60 ml-96 block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class=" icon-download"></span>  DESCARGAR BASE</p>
                    </div>
                </a>
            </div>
           
        <form action="leerexcel.php" method="POST" enctype="multipart/form-data" accept="xlsx/*">
            <div  class="drop-zone">
            <span class="drop-zone__prompt">Subir un archivo aquí</span>
                <input class="drop-zone__input" type="file" name="txt_archivo"  >
            </div>
            <br>
            <div class="ml-96 ">
            <input class=" ml-96 block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700" type="submit" value="Guardar" name="btnGuardar" onclick="inicio()" class="btn">
            </div>
        </form>
    </section>
    <script src="js/style.js"></script>
</body>
</html>