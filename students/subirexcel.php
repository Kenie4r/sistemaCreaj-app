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
    <h1 class="lg:justify-center text-center lg:w-3/4 lg:w-full lg:text-5xl md:text-4xl sm:text-3xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Agregar estudiante por excel</h1>
        
        <div class="mx-60 mt-10 flex lg:justify-end ml-9 lg:m-9 md:m-9 sm:m-9 lg:justify-center md:justify-center sm:justify-center">
            <p class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 "><b>Aviso:</b> Acontinuación se muestra un modo de subir datos mucho más fácil, para ello es necesario un documento excel,
             este es funcional desde Excel 2007, además es necesario usar un molde especifico para poder usar este tipo de guardado.</p>
        </div>
            <div class="flex lg:justify-end ml-9 lg:m-9 text-center content-center lg:justify-center md:justify-center sm:justify-center">
                <a href="base.xlsx">
                    <div class="lg:w-full md:w-full sm:w-full lg:mt-5 md:mt-5 sm:mt-5">
                        <p class="content-center lg:justify-center block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class=" icon-download"></span>  DESCARGAR BASE</p>
                    </div>
                </a>
            </div>
           
        <form action="readmybase.php" method="POST" enctype="multipart/form-data" accept="xlsx/*">
            <div  class="drop-zone">
            <span class="drop-zone__prompt">Subir un archivo aquí</span>
                <input class="drop-zone__input" type="file" name="txt_archivo" required >
            </div>
            <br>
            <div class="flex lg:justify-end ml-9 lg:m-9 md:m-9 sm:m-9 text-center content-center lg:justify-center md:justify-center sm:justify-center">
            <input class="content-center lg:justify-center block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700" type="submit" value="Guardar" name="btnGuardar" onclick="inicio()" class="btn ">
            </div>
        </form>
    </section>
    <script src="js/style.js"></script>
</body>
</html>