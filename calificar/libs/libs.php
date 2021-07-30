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
        $criterioName  = array();
        $criterioValue = array();
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
            <div class='text-center text-2xl'>
                <h2>Evaluación de criterios</h2>
            </div>
        ";
        print($html);
        return array($teamData[6], $teamData[7]);
    }

    public function writeRubric($idNivel, $idMateria){
        $query = new Query();
        $myCID = array();
        $myRubric = $query->getNewRubric($idMateria, $idNivel);
       foreach($myRubric as $a=> $b){
          foreach($b as $c){
              $idRubric = $c;
          }
       }
        $critics= $query->getIdCriterioByIdRubric($idRubric);
        foreach($critics as $field =>$array){
            foreach($array as $a => $b){
                $myCID[]=$b;
            }
        }
        $defCriterios = $query->getCriteriosByIdRubric($idRubric);

        foreach($defCriterios as $a){
            $j = 0;
            foreach( $a as  $b){
                if($j==1){
                    $criterioName[] = $b;
                }else if($j==2){
                    $criterioValue[]  =$b;
                }
                $j++;
            }

        }
        $html = "";
        for($index = 0; $index<count($myCID); $index++){
            $html.=" <div class='tab'class='criterio p-5'>
            <input type='hidden' name='' value='{$criterioValue[$index]}' id='valor{$index}'>
            <input type='checkbox' class='absolute opacity-0' id='btnCriterio{$index}'>
            <input type='hidden' id='Final{$index}' value='' class='final'>
            <label for='btnCriterio{$index}' class='block p-5 leading-normal cursor-pointer'>{$criterioName[$index]} </label>
            <div class='w-auto contenido overflow-hidden  border-1-2 bg-gray-100 border-indigo-500 leading-norma '>
                    <div class='grid grid-cols-2  gap-1 p-5' id='div$index'>
                        <div class='col-span-2 text-xl text-center transicion '><h3>¿Cómo fue su rendimiento?</h3></div>
                        <input type='radio'  id='promedio1_$index' class='promedios absolute opacity-0' name='promedios$index ' required>
                        <input type='radio'  id='promedio2_$index' name='promedios$index' class='promedios absolute opacity-0' required>
                        <input type='radio'  id='promedio3_$index' name='promedios$index' class='promedios absolute opacity-0' required>
                        <input type='radio'  id='promedio4_$index' name='promedios$index' class='promedios absolute opacity-0 ' required>
                        <label for='promedio1_$index'class='promediosL rounded-lg border-2 border-blue-500 text-blue-500 p-1 text-md  text-center hover:bg-blue-400 hover:text-white cursor-pointer'>Nivel Básico</label>
                        <label for='promedio2_$index' class='promediosL rounded-lg border-2 border-blue-500 text-blue-500 p-1 text-md  text-center hover:bg-blue-400 hover:text-white cursor-pointer'>Bueno</label>
                        <label for='promedio3_$index' class='promediosL rounded-lg border-2 border-blue-500 text-blue-500 p-1 text-md  text-center hover:bg-blue-400 hover:text-white cursor-pointer'>Muy Bueno</label>
                        <label for='promedio4_$index' class='promediosL rounded-lg border-2 border-blue-500 text-blue-500 p-1 text-md  text-center hover:bg-blue-400 hover:text-white cursor-pointer'>Excelente </label>
                    </div>
                    <div  class='p-5 transicion calificaciones' id='calificar$index'>
                    </div>
            </div>
        </div>";
        }
        print($html);
    }
    public function endDocument(){
        $endOfFile = <<<'HEREDOC'
        <div class="w-full p-2 text-center"><h1 class="text-xl">La nota final es:</h1></div>
                    <div class="flex flex-row p-2 text-xl justify-center items-center">
                        <div class="relative bg-gray-400 h-6 w-9/12 rounded-lg ">
                            <div class="abosulute bg-blue-400 h-6 rounded-lg" id="progress"></div>
                        </div>
                        <div>
                            <p class="px-2 w-3/12" id="finalGrade">0</p>
                        </div>
                        <input type="hidden" name="grade" value="" id="inputGrade">
                    </div>
                    <div class="flex flex-row items-center justify-center p-5 w-full">
                        <div class="border-2 border-blue-500 text-xl p-2 text-blue-500 hover:bg-blue-400 hover:text-white cursor-pointer" id="btnTerminar">Guardar nota</div>
                    </div>
                </form>
            </div>
        </div>
        <script src="../js/script_insertGrades.js"></script>
    </body>
</html>
HEREDOC;

        print($endOfFile);

    }
}




?>