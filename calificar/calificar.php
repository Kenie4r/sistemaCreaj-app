<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    require('libs/libs.php');
    //definimos variables que se usaran en todo el documento
    $query = new Query();
    $idTeam = $_GET['teamID'];
    $user = $query->getUserByUsername($_SESSION['uid']);
    $userID = $user['idUsuario'];
    $contador = $query->isSavedProject($idTeam, $userID);
    foreach($contador as $camps){
        foreach($camps as $c){
            $graded = $c;
        }
    }
        $idRubric  = array();
    //Crea la primera parte del header, antes de leer los datos
        $htmlCreator= new html();

    //Con esta función creo el header y titulo del sitio web, no tiene ninguna interacción con la base de datos
        $htmlCreator->headerHTML();
        //vamos a crear el nav
        require('../Dashboard/Dashboard.php');

    //con la siguiente función buscaremos la materia y grado, además de que nos escribira 
    //los datos del equipo, como descripción y también el nombre del equipo
        $idRubric =  $htmlCreator->getTeam($_GET['teamID'], $_SESSION['uid']);//nos ayudara a obtener los datos de para buscar la rúbrica
        $htmlCreator->writeRubric($idRubric[0], $idRubric[1]);
        $htmlCreator->endDocument();
        
    if($graded>0){
        $html = "<div id='notification' class='container  max-w-full  w-screen bg-gray-900 fixed h-screen bg-opacity-75 top-0  flex flex-col justify-center items-center'>
        <div class='bg-white max-w-sm text-center opacity-100 p-2 flex flex-col items-center justify-center w-full sm:max-w-md'>
        <div class='w-10 h-10 bg-red-500  text-white text-2xl flex items-center justify-center rounded-full'>
         <span class='icon-cross'></span>
     </div>
       <div class='text-lg'>
        <h1>¡Proyecto ya calificado!</h1>
        </div>
        <div class='bg-gray-200 p-2 rounded-lg cursor-pointer ' id='option-1'>
            <a href='index.php'><h1>Volver a \"Proyectos a calificar\"</h1></a>
         </div>";
         print($html);
     }
?>