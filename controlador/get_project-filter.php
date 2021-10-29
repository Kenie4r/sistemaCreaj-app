<?php
    require("../modelo/conection.php");
    require("../modelo/query.php");
    //obtenemos los datos que nos van a pasar por el metodo post
    $html = "";
    $existe = false;
    $userID = $_POST['userID']?$_POST['userID']:""; 
    $grado = $_POST['grado']?$_POST['grado']:"";
    $materia = $_POST['materias']?$_POST['materias']:"";
    $text = $_POST['text']?$_POST['text']:"";
    $querys = new Query();
    $calificadoshtml = "<h3>Proyectos ya calificados</h3>";

    if($materia == "all" && $grado=="all"){
            $data = $querys->getProjectsinfo($userID);
    }else if($materia == "all"){
            $data = $querys->getProjectsinfobyG($userID, $grado);
    }else if($grado == "all"){
            $data = $querys->getProjectsinfobyM($userID, $materia);
    }else{
            //en dado caso que susceda algún error prevenimos
            $data = $querys->getProjectsinfobyGandM($userID, $grado, $materia);
    }
 
   
    
    if(count($data)==0){
        echo("No hay proyectos");
    }
    $exist= false;
    for($ix = 0; $ix<count($data); $ix++){
        if($text ==""){
            $info = $querys->getAllProjects($data[$ix]['materia_idmateria'], $data[$ix]['grado_idgrado']);
        }else{
            $info = $querys->searchProyectsByNameAndMatterAndGrade($text, $data[$ix]['grado_idgrado'], $data[$ix]['materia_idmateria'],);
        }
        $dataMateria = $querys->getMatterById($data[$ix]['materia_idmateria']);
        $dataGrado = $querys->getGradeById2($data[$ix]['grado_idgrado']);
        foreach($info as $proyecto){
            $calificado = $querys->isSavedProject($proyecto['idproyecto'], $userID);
            if($calificado[0]['COUNT(*)']>0){
                $existe = true;
                $graded = $querys->getPoints($userID,$proyecto['idproyecto'] );
                $calificadoshtml .= "<div class='w-10/12 bg-white p-5 flex-col ' >
                <div class='flex flex-col items-center w-full md:flex-row justify-between'>
                    <div class='w-full md:w-7/12'>
                        <div class='font-bold  text-lg '>
                            <h3>{$proyecto['nombreProyecto']}</h3>
                        </div>
                    </div>
                    <div class='w-full md:w-4/12 flex justify-end '>
                        <p class='p-2 bg-gray-400  md:w-10/12 text-center text-white m-auto' >
                            Proyecto calificado: {$graded[0]['points']}
                        </a>
                    </div>
                </div>
                <div class='w-full p-2'>
                    <p class='text-justify text-sm '>
                        {$proyecto['descripcion']}
                    </p>
                </div>
                <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
            </div>
            </div>";
            }else{
                $html.= "<div class='w-10/12 bg-white p-5 flex-col ' >
                <div class='flex flex-col items-center w-full md:flex-row justify-between'>
                    <div class='w-full md:w-7/12'>
                        <div class='font-bold  text-lg '>
                            <h3>{$proyecto['nombreProyecto']}</h3>
                        </div>
                    </div>
                    <div class='w-full md:w-4/12 flex justify-end '>
                        <a class='p-2 bg-blue-600  md:w-10/12 text-center text-white cursor-pointer m-auto' href='calificar.php?teamID={$proyecto['idproyecto']}'>
                            Calificar proyecto
                        </a>
                    </div>
                </div>
                <div class='w-full p-2'>
                    <p class='text-justify text-sm '>
                        {$proyecto['descripcion']}
                    </p>
                </div>
                <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
            </div>
            </div>";
            }
        }
        
    }
    if( $existe == true){
        $html.= $calificadoshtml;
    }

    print($html);



?>