<?php
    require('../../modelo/conection.php');
    require('../../modelo/query.php');
//Instanción de la variable Query
    $query = new Query();
    //Definición de las variables
    $notaFinal = $_POST['finalGrade']?$_POST['finalGrade']:"";
    $idTeam = $_POST['txtIdTeam']?$_POST['txtIdTeam']:"";
    $userID = $_POST['txtuserID']?$_POST['txtuserID']:"";
    $materia =$_POST['subjecttxt']?$_POST['subjecttxt']:"";
    $grado = $_POST['levelttxt']?$_POST['levelttxt']:"";
    $criterios = $_POST['criterios'];
    $notasobtenidas = $_POST['notasc'];
    $notasM = $_POST['notasM'];
    $notasumada = 0;
    for($i = 0; $i<count($notasM); $i++){
        $notasumada += $notasM[$i];
    }
    if($notasumada!= $notaFinal){
        $notaFinal = $notasumada;
    }
    $notaFinal = round($notaFinal, 2);
  $result = $query->savePuntaje($idTeam, $userID, $notaFinal);
    if($result =="Registro hecho"){
        for($index = 0; $index<count($criterios); $index++){
            $saveGrades = $query->savePuntos($notasobtenidas[$index], $criterios[$index], $userID, $idTeam);
         }
       $counted = $query->getCountRatedProject($idTeam);
       if($counted['COUNT(*)']>1){
           $grade = 0;
           $allRates = $query-> getRatedsProject($idTeam);
           foreach($allRates as $camp){
               $grade +=$camp['puntaje'];
           }
           $grade/=$counted['COUNT(*)'];
           $ranked = $query-> updateRanking($idTeam, $grade);
       }else{
            $grade =$notaFinal;
            $ranked= $query-> saveRank($idTeam, $materia, $grado,$grade);
       }
       print($ranked);
        
       $html = "
       <div id='notification' class='container  max-w-full  w-screen bg-gray-900 fixed h-screen bg-opacity-75 top-0  flex flex-col justify-center items-center'>
            <div class='bg-white max-w-md text-center opacity-100 p-2 flex flex-col items-center justify-center w-full sm:max-w-md rounded-lg'>
                <div class='w-10 h-10 bg-green-500  text-white text-2xl flex items-center justify-center rounded-full'>
                    <span class='icon-checkmark'></span>
                </div>
                <div class='text-lg'>
                    <h1>El proyecto ha sido calificado, este obtuvo: {$notaFinal}/50 puntos</h1>
                </div>
                <a class='bg-gray-200 p-3 rounded-lg cursor-pointer ' href='index.php'>
                    <h1>Volver a mis proyectos</h1>
                </a>
            </div>
        </div>
       ";
    }else{
        $html = "
       <div id='notification' class='container  max-w-full  w-screen bg-gray-900 fixed h-screen bg-opacity-75 top-0  flex flex-col justify-center items-center'>
            <div class='bg-white max-w-md text-center opacity-100 p-2 flex flex-col items-center justify-center w-full sm:max-w-md'>
                <div class='w-10 h-10 bg-red-500  text-white text-2xl flex items-center justify-center rounded-full'>
                    <span class='icon-cross'></span>
                </div>
                <div class='text-lg'>
                    <h1>Hubo un error al guardar los puntos</h1>
                </div>
                <a class='bg-gray-200 p-5 rounded-lg cursor-pointer ' hred='index.php'>
                    <h1>Volver a mis proyectos</h1>
                </a>
            </div>
        </div>
       ";
    }
    print($html);
    ?>