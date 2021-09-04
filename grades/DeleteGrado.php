<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
    /*if (isset($_GET['id'])) {
       $id=$_GET['id'];
       $guardarNom=$consulta->deleteGrado($id);
       echo "se pudo borrar";
    }else {
        echo "no se pudo borrar";
    }*/
?>
 <!DOCTYPE html>
   <html lang="es">
   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Crea J | Guardar Materia</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
       <title>Borrar grado</title>
   </head>
   <body> 
   <?php
  require('../Dashboard/Dashboard.php')

?>
       <?php
            if (isset($_GET['id'])) {
                $id=$_GET['id'];
                $guardarNom=$consulta->deleteGrado($id);
                ?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">Se ha borrado con éxito.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="Index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <?php
             }else {
                ?>
                <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, El grado no se borró con exito.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="Index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
                <?php 
             }
       ?>
   </body>
   </html>