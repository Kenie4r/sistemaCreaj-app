<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");



$query = new Query();

    $query->deleteRank();
    $query->deletePuntos();
    $query->deletePuntaje();
    $query->deleteProyectos();
    $query->deleteEstudiantes();
    $query->deleteAsignacionJ();
    $query->deleteNAprobacion();
    $query-> deleteCriterios();
    $query-> deleteRubricas();
    $query->deleteGrados();
    $query->deleteMaterias();
    $query->deleteNivel();
    $query->deleteParams();
    $query->deleteUsuarios();

   $query->createAdmin();
    $query->createLevel();
    $query->createGrade();
    $query->createSubject();
    $query->createParams();

    $html  = <<<EDO
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CreaJ| Calficar equipo</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../recursos/icons/style.css">
    </head>
    <body>
        <div class='fixed  h-screen w-screen bg-gray-900 top-0 left-0  bg-opacity-70 flex  flex-col items-center justify-center ' id='cargar'>
            <div class='bg-white h-3/6 w-5/12 rounded-lg flex justify-center flex-col items-center '>
                <div class='text-green-600 text-center w-full  text-4xl p-2 m-4' >
                    <p class=''>
                        <span class=''>DATOS ELIMINADOS</span>
                    </p>    
                </div>
            <div class=' m-2 text-xl'>
                <a href='../index.php' class='bg-blue-400 text-white p-2'>Volver al incio</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    EDO;


    print($html);
?>