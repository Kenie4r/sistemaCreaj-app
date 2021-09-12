<?php
    class ranking{
        public function header2(){
            $html = <<<EDO
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Ranking</title>
                <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                <link rel='stylesheet' href='../../recursos/icons/style.css'>
                <script src='../js/script-ranking.js'></script>
                <script src="../Dashboard/js/button2.js"></script>
            </head>
            <body>
            EDO;

            print($html);
        }
        public function header(){
            $html = <<<EDO
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>CreaJ | Ranking</title>
                <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                <script src="../Dashboard/button.js"></script>
                <link rel='stylesheet' href='../recursos/icons/style.css'>
                <link rel='stylesheet' href='../recursos/icons/style.css'>
                <script src='../js/script-ranking.js'></script>
                <script src="../Dashboard/js/button2.js"></script>
            </head>
            <body class='overflow-x-hidden'>
            EDO;

            print($html);
        }

        public function body(){

            $html = <<<EDO
            <div class=' h-screen w-screen flex flex-col  items-center justify-center rounded-2xl shadow  md:p-1'>
            <div class=' h-full  w-10/12 border shadow-lg bg-white flex flex-col md:flex-row overflow-x-hidden  '>
                    <div class='grados bg-indigo-700 w-full h-3/6 rounded-md flex flex-col items-center md:h-full'>
                        <div class='text-white my-2 text-justify p-5'>
                            <h1 class='text-center text-xl'>Selección de grados para ver el Ranking</h1>
                            <p>Seleccione un grado, luego en el apartado de materias seleccione la materia
                                 para poder ver el PDF donde aparecen todos los proyectos con los 3 mejor calificados.</p>
                        </div>
                        <div class='w-10/12 overflow-auto md:h-full'>
            EDO;

            print($html);
        }
        public function generateGrades($type, $username){
            $blockhtml = "";
            $query = new Query();
            if($type == "a" || $type=="t"){
                $grados = $query->getGrado();
            }else if($type == "i"){
                $userdata = $query->getUserByUsername($username);
                $info = $query->getProjectsinfo($userdata['idUsuario']);
                foreach($info as $datasc){
                    $grado = $query->getGradeById2($datasc['materia_idmateria']);
                    foreach($grado as $campo){
                        //vamos a escribir cada uno de los grados dentro del box
                        $nProyectos  = $query->getCountPojectsByGrade($campo['idgrado']);
                        if($nProyectos['COUNT(*)']>0){
                        $blockhtml .= "<div class='bg-white w-full shadow-xl p-2 flex flex-row justify-between my-2'>
                        <!--Primero irá el nombre del grado-->
                        <div class='text-center'>
                         <h1 class='text-2xl'>{$campo['nombre']}  {$campo['seccion']}</h1>
                        </div>
                        <!--Un botón para seleccionar al grado-->
                        <div>
                            <div class='button p-2 border border-2 bg-blue-500 text-white cursor-pointer btnGrade' id='btn-{$campo['idgrado']}'>
                                <p>Ver materias</p>
                            </div>
                        </div>
                        </div>";
                        }
                    }
                }
            }
     
            if(!empty($grados) && $type!="i"){
                foreach($grados as $campo){
                    //vamos a escribir cada uno de los grados dentro del box
                    $nProyectos  = $query->getCountPojectsByGrade($campo['idgrado']);
                    if($nProyectos['COUNT(*)']>0){
                    $blockhtml .= "<div class='bg-white w-full shadow-xl p-2 flex flex-row justify-between my-2'>
                    <!--Primero irá el nombre del grado-->
                    <div class='text-center'>
                     <h1 class='text-2xl'>{$campo['nombre']}  {$campo['seccion']}</h1>
                    </div>
                    <!--Un botón para seleccionar al grado-->
                    <div>
                        <div class='button p-2 border border-2 bg-blue-500 text-white cursor-pointer btnGrade' id='btn-{$campo['idgrado']}'>
                            <p>Ver materias</p>
                        </div>
                    </div>
                    </div>";
                    }
                }
            }
                $blockhtml.="</div>
                </div>";
                print($blockhtml);
        }
        public function creatematerias(){
            $html = <<<EDO
            <div class='materias bg-white w-full h-full h-3/6 p-5 flex flex-col items-center md:h-full '>
            <div class='text-xl my-2'>
                <h1>Seleccione una materia para descargar su PDF</h1>
            </div>
            <div class='w-10/12 overflow-auto  md:h-full' id='boxSubjects'>
                <p class="text-gray-400 text-2xl text-center"><span class="icon-cross"></span><br>Aún no has seleccionado ningún grado, por favor seleccione uno </p>
            </div>
            </div>
            </div>
            </div>
            </body>
            </html>
            EDO;

            print($html);
        }
        public function infoData($idMateria, $idGrado){
        
            $query = new Query();
            $materiaInfo = $query->getMatterById($idMateria);
            $gradoinfo = $query-> getGradobyID($idGrado);
            $blockhtml = "
            <div class='h-full w-full flex flex-col p-5 items-center rounded-2xl shadow bg-gray-100'>
            <div  class='w-full'>
                <div class='w-1/12 mx-auto'>
                    <img src='img/trophy.png' alt='trofeo' class='block mx-auto'>
                </div>
                <div class=' m-3'>
                    <div class='text-center text-2xl uppercase'>
                        <h1>RANKING DE {$materiaInfo['nombre']} Y SUS PROYECTOS </h1>
                    </div>
                    <div>
                        <p class='px-12 text-justify'>
                            En este sitio se muestran todos los proyectos de la materia seleccionada 
                            anteriormente, se obtienen todos los proyectos de el grado {$gradoinfo['nombre']} 
                            y son mostrados de orde descendente siendo el primero el que mayor 
                            puntos en promedio ha conseguido gracias a las calificaciones de los jurados
                            , es posible obtener un PDF de este apartado dandole en \"descargar PDF\"
                        </p>
                    </div>
                   
    
            
            
            ";
            $proyectos = $query->getRankingDESC($idGrado, $idMateria);
            if(empty($proyectos)){
                $blockhtml .= "       <div class='flex flex-col   justify-center items-center h-80'>
                <div class='text-gray-400 text-xl'>
                    <h1 class='text-center text-6xl'>
                        <span class='icon-wondering2'></span>
                    </h1>
                    <h1>
                        Aún no hay ningún proyecto ganador vuelve más tarde.
                    </h1>
                </div>";
            }else{
                $blockhtml .= " 
                <div class='flex justify-center'>
                <a href='../libs/fpdfranking_doc.php?idGrado={$idGrado}&idMateria={$idMateria}' class='p-3 bg-red-500 text-white text-lg rounded-md'>
                    <span class='icon-file-pdf'></span>
                    Descargar PDF
                </a>
            </div>
        </div>
                <div class='w-full flex flex-col items-center'>

                <!--Equipos ganadores-->
                <div class='grid grid-cols-1 w-7/12 lg:grid-cols-3 gap-2' id='box-ganadores'>";
                $c = 0;
                foreach($proyectos as $camps){
                    $proyectoInfo =$query->getTeambyID($camps['proyecto_idproyecto']);
           
                    $c++;
                    if($c==2){
                        $blockhtml .= "
                        <div class='flex flex-col items-center border shadow-xl p-4  bg-white  rounded-md'>
                        <div class='w-5/12'>
                            <img src='img/silver-medal.png ' alt='>
                        </div>
                        <div class='text-center text-xl w-full'>
                            <h1 class='w-full text-center'>{$proyectoInfo['nombreProyecto']}</h1>
                        </div>
                        <div class='text-center text-gray-400 text-xl'>
                            <h2>" . round($camps['notafinal'], 2) ." PUNTOS</h2>
                        </div>
                        <a href='../../Projects/evaluacionProyecto.php?proyecto={$camps['proyecto_idproyecto']}' target='_blank' class='m-2 p-2 bg-red-500 text-white text-md rounded-md'>
                            <span class='icon-file-pdf'></span>
                            Rúbrica
                        </a>
                    </div>";
                    }else if($c==1){
                      $html = "
                      <div  class='flex flex-col items-center border shadow-xl p-4 bg-white rounded-md'>
                      <div class='w-6/12'>
                          <img src='img/gold-medal.png' alt='>
                      </div>
                      <div class='text-center text-2xl w-full'>
                          <h1 class='text-center'>{$proyectoInfo['nombreProyecto']}</h1>
                      </div>
                      <div class='text-center text-gray-400 text-xl'>
                          <h2>" . round($camps['notafinal'], 2) ." PUNTOS</h2>
                      </div>
                      <a href='../../Projects/evaluacionProyecto.php?proyecto={$camps['proyecto_idproyecto']}' target='_blank' class='m-2 p-2 bg-red-500 text-white text-md rounded-md'>
                      <span class='icon-file-pdf'></span>
                      Rúbrica
                  </a>
                  </div>
                      ";

                    }else if($c==3){
                        $html.="
                        <div class='flex flex-col items-center  border shadow-xl p-4 bg-white  rounded-md'>
                        <div class='w-4/12'>
                            <img src='img/bronze-medal.png' alt='>
                        </div>
                        <div class='text-center text-md w-full'>
                            <h1 class='w-full text-center'>{$proyectoInfo['nombreProyecto']}</h1>
                        </div>
                        <div class='text-center text-gray-400 text-xl'>
                            <h2>" . round($camps['notafinal'], 2) ." PUNTOS</h2>
                        </div>
                        <a href='../../Projects/evaluacionProyecto.php?proyecto={$camps['proyecto_idproyecto']}' target='_blank' class='m-2 p-2 bg-red-500 text-white text-md rounded-md'>
                        <span class='icon-file-pdf'></span>
                        Rúbrica
                        </a>
                    </div>
                    </div>
                     

                        ";
                    }else if($c==4){
                        $html .= "<div class='text-center text-4xl m-3'> <h1>Demás concursantes </h1></div>
    
                        <!--Demas equipos-->
                        <div class='flex flex-col overflow-y-auto h-60  w-full md:w-10/12  justify-center items-center m-6'>   
                        
                        <div class='bg-white w-11/12 shadow-md h-20 border rounded-md flex flex-row justify-between items-center my-1'>
                        <div class='p-5 text-xl w-8/12 md:text-2xl'>
                            <h1>$c.<!--Numero en el que aparecio-->
                            {$proyectoInfo['nombreProyecto']}</h1>
                        </div>

                        <div class='text-center text-gray-400 text-xl p-5'>
                            <h2>" . round($camps['notafinal'], 2) ."  PUNTOS</h2>
                        </div>
                        <a href='../../Projects/evaluacionProyecto.php?proyecto={$camps['proyecto_idproyecto']}' target='_blank' class='m-2 p-2 bg-red-500 text-white text-md rounded-md'>
                            <span class='icon-file-pdf'></span>
                            Rúbrica
                        </a>
                        </div>";
                    }else{
                        $html .= "<div class='bg-white w-11/12 shadow-md h-20 border rounded-md flex flex-row justify-between items-center my-1'>
                        <div class='p-5 text-xl md:text-2xl'>
                            <h1>$c.<!--Numero en el que aparecio-->
                            {$proyectoInfo['nombreProyecto']}</h1>
                        </div>

                        <div class='text-center text-gray-400 text-xl p-5'>
                            <h2>" . round($camps['notafinal'], 2) ."  PUNTOS</h2>
                        </div>
                        <a href='../../Projects/evaluacionProyecto.php?proyecto={$camps['proyecto_idproyecto']}' target='_blank' class='m-2 p-2 bg-red-500 text-white text-md rounded-md'>
                            <span class='icon-file-pdf'></span>
                            Rúbrica
                        </a>
                        </div>";
                    }
                }
                $blockhtml.=$html;
            }
         

            print($blockhtml);
        }

    }
?>