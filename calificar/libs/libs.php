<?php
    class html(){
        
        function headerHTML(){
            $header = <<<'EDO'
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Calficar equipo</title>
                <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <link rel="stylesheet" href="../recursos/icons/style.css">
                <link rel="stylesheet" href="css/styles_insertG.css">
            </head>
            <body  class="bg-teal-900 w-screen h-screen rounded-lg overflow-x-hidden">
                <div class="container bg-white w-9/12 max-w-xl  m-auto max-w-xl  rounded-2xl">
                        <div class="bg-gray-100 p-2  ">
                            <div class="text-2xl font-bold uppercase">
                                <h1 class="text-center">sistema de calificación</h1>
                            </div>  
        EDO;

        print($header);
     }
    }
    //siguiente función para leer datos
    function getTeam($idTeam){
        $query = new Query();
        $teamData = array(0,'', '', 0,0);

        $c = 0;
        $data = $query->getTeamData($idTeam);
        foreach ($data as $campo => $a) {
            foreach($a as $dato){
                $teamData[$c]=$dato;
                $c++;
            }

        }

        $body = <<<'EOT'
        <div class="text-xl text-left">
        <div >
            <p class="p-5"><span class="font-bold">Nombre de proyecto: </span>
            </p>
           
        </div>
        <div>
            <p class="p-5"><span class="font-bold">Grado y sección: </span>III año  B Desarrollo de Software</p>
        </div>
       EOT;



        print($body);

    }

?>