<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
    //vamos a obtener los datos de cada uno de los proyectos
    $userID = $_POST['userID'];
    $texto = $_POST['name'];
    $query = new Query();
    $html = "";
    $c = 0; $withGrade="<div class='text-center text-xl'><h1>Proyectos ya calificados</h1></div>";
    $asigna = $query->getProjectsinfo($userID);
    $k = 0;
    foreach($asigna as $campo ){
   
        $nombre = "%" .$texto. "%";
        $info = $query->findPorjectbyN($nombre, $campo['grado_idgrado'],  $campo['materia_idmateria']);
        $dataMateria = $query->getMatterById($campo['materia_idmateria']);
        $dataGrado = $query->getGradeById2($campo['grado_idgrado']);
        if($texto == "" || empty($texto)){
            foreach($info as $result){
                $calificado = $query->isSavedProject($result['idproyecto'], $userID);
                foreach( $calificado as $camp){
                    foreach($camp as $myre){
                        if($myre>0){
                            $c+=1;
                            $graded = $query->getPoints($userID,$result['idproyecto'] );
                            foreach($graded as $mycamp){
                                $grade = $mycamp['points'];
                            }
                            $withGrade .="<div class='bg-white sm:w-8/12 w-10/12 border border-2 p-5 roundend-full m-auto shadow-md my-7'>
                            <div class='flex w-full flex-col sm:flex-row items-center justify-between'>
                                    <div class='text-lg font-bold '>
                                        <h1>{$result['nombreProyecto'] }</h1>
                                    </div>
                                    <div class='text-center '>
                                        <p class='p-1 border border-2 border-blue-400 text-blue-400 w-40 mx-auto mt-2'>
                                           Obtuvo: {$grade}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    {$result['descripcion']}
                                </div>   
                                <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                                    <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                                    <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
                                </div>
                            </div>
                        ";
                        }else{ 
                        
                            $html.="<div class='bg-white sm:w-8/12 w-10/12 border border-2 p-5 roundend-full m-auto shadow-md my-7'>
                                                <div class='flex w-full flex-col sm:flex-row items-center justify-between'>
                                                        <div class='text-lg font-bold '>
                                                            <h1>{$result['nombreProyecto'] }</h1>
                                                        </div>
                                                        <div class='text-center '>
                                                            <p class='p-1 border border-2 border-blue-400 text-blue-400 w-40 mx-auto mt-2 hover:bg-blue-400 hover:text-white  cursor-pointer'>
                                                                <a href='calificar.php?teamID={$result['idproyecto']}'>
                                                                    Calificar proyecto
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        {$result['descripcion']}
                                                    </div>   
                                                    <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                                    <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                                    <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
                                </div>
                                                </div>
                                    ";
                        
                        }
                    }
                }
            }
        }else{
            if(!empty($info)){
                foreach($info as $result){
                    $calificado = $query->isSavedProject($result['idproyecto'], $userID);
                    foreach( $calificado as $camp){
                        foreach($camp as $myre){
                            if($myre>0){
                                $c+=1;
                                $graded = $query->getPoints($userID,$result['idproyecto'] );
                                foreach($graded as $mycamp){
                                    $grade = $mycamp['points'];
                                }
                                $withGrade .="<div class='bg-white sm:w-8/12 w-10/12 border border-2 p-5 roundend-full m-auto shadow-md my-7'>
                                <div class='flex w-full flex-col sm:flex-row items-center justify-between'>
                                        <div class='text-lg font-bold '>
                                            <h1>{$result['nombreProyecto'] }</h1>
                                        </div>
                                        <div class='text-center '>
                                            <p class='p-1 border border-2 border-blue-400 text-blue-400 w-40 mx-auto mt-2'>
                                               Obtuvo: {$grade}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        {$result['descripcion']}
                                    </div>   
                                    <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                                        <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                                        <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
                                    </div>
                                </div>
                            ";
                            }else{ 
                            
                                $html.="<div class='bg-white sm:w-8/12 w-10/12 border border-2 p-5 roundend-full m-auto shadow-md my-7'>
                                                    <div class='flex w-full flex-col sm:flex-row items-center justify-between'>
                                                            <div class='text-lg font-bold '>
                                                                <h1>{$result['nombreProyecto'] }</h1>
                                                            </div>
                                                            <div class='text-center '>
                                                                <p class='p-1 border border-2 border-blue-400 text-blue-400 w-40 mx-auto mt-2 hover:bg-blue-400 hover:text-white  cursor-pointer'>
                                                                    <a href='calificar.php?teamID={$result['idproyecto']}'>
                                                                        Calificar proyecto
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            {$result['descripcion']}
                                                        </div>   
                                                        <div class='w-full flex flex-row items-center text-sm text-white my-1'> 
                                        <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-book'></span> {$dataMateria['nombre']}</div>
                                        <div class='text-gray-400 p-1 rounded-lg m-1'><span class='icon-user'></span> {$dataGrado[0]['nombre']} {$dataGrado[0]['seccion']}</div>
                                    </div>
                                                    </div>
                                        ";
                            
                            }
                        }
                    }
                }

            }else{
                $html = "
                <div class='text-gray-400 text-xl w-8/12 h-full m-auto  mt-10'>
                    <h1 class='text-center text-6xl'>
                    <span class='icon-sad2'></span>
                </h1>
                <h1 class='text-center'>
                    No se encuentra ningún proyecto.
                </h1>
                 </div>
                
                
                ";



            }
        
        }
    
    
    }
    if($c >0){
        $html .= $withGrade ;
    }
     
    print($html);


?>