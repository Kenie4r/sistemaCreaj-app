<?php
    class html{
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
                            <div class="text-xl text-left">
        EDO;

        print($header);
     }
    
    //siguiente función para leer datos
    function getTeam($idTeam){
        $query = new Query();
        $teamData = array();
        $integrantes = array();
        $c = 0;
        $data = $query->getTeamData($idTeam);
        foreach ($data as $campo => $a) {
            foreach($a as $dato){
                //Se retornaran 9 dato

                $teamData[] =$dato;
                 $c++;
            }

        }

        //escribiremos todo el HTML con los datos obtenidos
        $html = " <div >
            <p class='p-5'><span class='font-bold'>Nombre de proyecto: </span>{$teamData[1]}</p>
            </div>";//en este insertamos el nombre del proyeto
        $html .= "<div>
                    <p class='p-5'><span class='font-bold'>Grado y sección: </span>{$teamData[4]} {$teamData[5]}</p>
                    </div>";


        $data = $query->obtainTeamMates($idTeam);
        foreach($data as $campo=>$a){
            $c= "";
            $i = 0;
            foreach($a as $b){
                if($i> 0){
                    $c .= $b. " ";
                }
                $i++;
            }
            $integrantes[] = $c;
       }  
        $html.= " <div class='tab w-full overflow-hidden border-t'>
        <input class='absolute opacity-0' type='checkbox' id='btn-integrantes' name='btns'>
        <label for='btn-integrantes' class='block p-5 leading-normal cursor-pointer'>Integrantes</label>
          <div class='contenido overflow-hidden border-1-2 bg-gray-100 border-blue-500 leading-normal'>
                  <ul class='p-5' >";
        for($i = 0 ; $i<=count($integrantes)-1; $i++){
            $html.= "<li>$integrantes[$i]</li>";
        }
        $html.= "</ul>
          </div>
  </div>";

        $html.="
        <div class='tab w-full overflow-hidden border-t'>
                <input class='absolute opacity-0' type='checkbox' id='btn-integrantes2' class='' name='btns'>
                <label for='btn-integrantes2' class='block p-5 leading-normal cursor-pointer'>Descripción</label>
                <div class='contenido overflow-hidden border-1-2 bg-gray-100 border-indigo-500 leading-normal'>
                    <p class='p-5'> $teamData[2]</p>
            </div>
        </div>
        </div>
        </div>
        ";

        $html.= "
        <div class='bg-gray-100'>
        <form action='' method='post' id='form'>
            <input type='hidden' name='txtIdTeam'  value='$idTeam'>
            <div class='text-center text-xl'>
                <h2>Evaluación de criterios</h2>
            </div>
        ";
        print($html);
        return array($teamData[6], $teamData[7]);
    }

    public function writeRubric($idNivel, $idMateria){
        $query = new Query();
        $myRubric = $query->getNewRubric($idMateria, $idNivel);
        
    }
}





?>