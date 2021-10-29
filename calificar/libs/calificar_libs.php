<?php
 class htmlCreator{
    //función de creación de header
    public function header(){
        $header=  "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Proyectos</title>
                <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
                <link rel='stylesheet' href='../recursos/icons/style.css'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                <link rel='stylesheet' href='css/style.css'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script src='../Dashboard/button.js'></script>
                <script src='../js/calificar-search.js'></script>
                <script src='../Dashboard/js/button2.js'></script>

            </head>";

        print($header);
    }
    public function createData($userdata){
        //modelo de query
        $querys = new Query();
        $user = $querys->getUserByUsername($userdata);
        $userID = $user['idUsuario'];
        //obtuvimos los datos del usuario además de obtener el ID
        //obtenemos los datos, siendo primero las materias y grados otbenidos
        $nAsignaciones = $querys->getCountProjects($userID);
        $number = $nAsignaciones[0]['COUNT(*)'];

        if($number ==0){
            $html =<<<'EDO'
            <div class='flex flex-col   justify-center items-center w-full h-full'>
            <div class='text-gray-400 text-xl'>
                <h1 class='text-center text-6xl'>
                    <span class='icon-wondering2'></span>
                </h1>
                <h1>
                    Aún no hay ningún proyecto para calificar.
                </h1>
            </div>
            EDO;
            print($html);
        }else{
            //vamoa a leer todos los proyecotos del usuario
            $dataM = $querys->getgradeinfo($userID);
            $html = " 
            <div class='w-full h-screen flex border-box overflow-hidden flex-col md:flex-row m-0 relative'>
            <div class='bg-gray-800 p-3 absolute top-0 left-0 text-white  cursor-pointer btn-aparecer  md:hidden z-30' id='btnSearch'>
            <span class='icon-circle-left'></span>
        </div>
        <div class='h-full w-11/12 bg-white absolute desaparecer   md:static  md:w-3/12  border-r-2 text-gray-200  bg-gray-800 z-40 flex flex-col justify-between ' id='divBusqueda'>
                <div class='flex items-center p-2  justify-between flex-row' >
                    <div class='cursor-pointer text-white text-sm text-center md:hidden'   id='btn-cerrar'>
                        <span class='icon-cross '></span>
                    </div>
                    <div class='text-2xl text-center p-2 w-full '>
                        <h1>Filtros de proyectos </h1>
                    </div>
                </div>
           
                <div class='border-t-2 h-2/6'>
                    <div class='p-2'>
                        <div class='text-lg text-center'>
                            <h2>Grados asignados</h2>
                        </div>

                       
                        <div class='text-md'>
                            <div class=' py-1 px-5  text-gray-200  w-full flex justify-between  items-center  '>
                                <label for='checkGrado_all' class='m-2 cursor-pointer'>Todos los grados</label>
                                <input type='radio' name='rdbGrados' id='checkGrado_all' class='check_grados' checked value='all' data-name='Todos los grados'>
                            </div>";

                foreach($dataM as $campo){
                    $grado =  $querys->getGradeById2($campo['grado_idgrado']);
                    $html.= "<div class=' py-1 px-5  text-gray-200  w-full flex justify-between  items-center  '>
                    <label for='checkGrado_{$campo['grado_idgrado']}' class='m-2 cursor-pointer'>{$grado[0]['nombre']} {$grado[0]['seccion']}</label>
                    <input type='radio' name='rdbGrados' id='checkGrado_{$campo['grado_idgrado']}' class='check_grados' value='{$campo['grado_idgrado']}' data-name='{$grado[0]['nombre']}'>
                    </div>";
                }
                $html.= "</div>
                </div>
                </div>
                <div class='h-2/6 max-h-2/6 border-t-2 overflow-hidden'>
                <div class='p-2 overflow-y-auto h-full'>
                    <div class='text-lg text-center'>
                        <h2>Materias asignadas</h2>
                    </div>
                    <div class='text-md overflow-y-auto h-5/6 '>
                        <div class=' py-1 px-5  text-gray-200  w-full flex justify-between  items-center  '>
                            <label for='checkSub_all' class='m-2 cursor-pointer'>Todas las materias</label>
                            <input type='radio' name='rdbSubjects' id='checkSub_all' class='check_subjects'  value='all' checked data-name='Todas las materias'>
                        </div>";

                $dataS = $querys->getsubinfo($userID);
                foreach($dataS as $campo){
                    $grado =  $querys->getMatterById($campo['materia_idmateria']);
                    $html.= "<div class=' py-1 px-5  text-gray-200  w-full flex justify-between  items-center  '>
                    <label for='checkSub_{$campo['materia_idmateria']}' class='m-2 cursor-pointer'>{$grado['nombre']}</label>
                    <input type='radio' name='rdbSubjects' id='checkSub_{$campo['materia_idmateria']}' class='check_subjects' value='{$campo['materia_idmateria']}' data-name='{$grado['nombre']}'>
                    </div>";
                }
                $html.="</div> </div></div> <div>
                <p class='p-5 bg-blue-600 text-white text-center cursor-pointer hover:bg-blue-500' id='btnBuscar_Proyectos'>Buscar</p>
                </div></div>";

                //vamos a ahora a escribir los proyectos de cada uno 
                $html.="<div class='flex flex-col w-full items-center h-full md:w-9/12 absolute right-0 top-0 z-10 md:z-0 ' >
                <div class='text-center p-5 text-2xl'>
                    <h1>Proyecto a calificar</h1>
                </div>
                <div>
                    <div>
                        <input type='hidden' name='' id='gradoB' value='all'>
                        <input type='hidden' name='' id='materiaB' value='all'>
                        <input type='hidden' name='' id='userID' value='{$userID}'>
                        <div class='flex flex-row gap-2 p-2 items-start justify-start'>
                            <p>Proyectos filtrados por: </p>
                            <p >Grado : <span class='bg-gray-200 rounded-lg p-1 text-gray-500 ' id='filter-g'> Todos los grados</span></p>
                            <p >Materia : <span class='bg-gray-200 rounded-lg p-1 text-gray-500 ' id='filter-s'>Todas las materias </span></p>
                        </div>
                    </div>
                </div>
                <div class='flex justify-start w-11/12 bg-gray-800 p-2 '>
                    <div class='w-full md:w-6/12 border border-1  text-white flex flex-row rounded-lg overflow-hidden items-center'>
                        <span class='icon-search p-3'> </span>
                        <input type='text' placeholder='Buscar un proyecto' class=' p-2 text-lg w-11/12 text-black' id='txtBuscar'>
                    </div>
                </div>
                <div id='proyectoBox' class='w-11/12 bg-gray-100 h-5/6 border border-1 p-2 flex flex-col items-center overflow-y-scroll gap-2'>";
                $calificadoshtml = "<h3>Proyectos ya calificados</h3>";
                $data = $querys->getProjectsinfo($userID);
                $exist= false;
                for($ix = 0; $ix<count($data); $ix++){
                    $info = $querys->getAllProjects($data[$ix]['materia_idmateria'], $data[$ix]['grado_idgrado']);
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
        }
    }


}



?>