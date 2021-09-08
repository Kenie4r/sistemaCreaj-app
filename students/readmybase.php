<?php
    $inputfile = $_FILES['txt_archivo']['tmp_name'];
    require 'composer/vendor/autoload.php';
    require_once("../modelo/conection.php");
    require_once("../modelo/query.php");
    //comienzo de código 
    //instacianmos la clase querty
    $query= new Query();

    //definicion de la propiedad para leer el archivo
   $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
   //Identificamos el tipo de archivo que vamos a recibir
   $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputfile);
    
   //vamos a comenzar a leer el archivo 
   $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
   //obtenemos nuestro excel
   $spreadsheet = $reader->load($inputfile);
    //vamos a obtener todos los datos de nuestra hoja de excel
    $array = $spreadsheet->getActiveSheet()->toArray("", true,true, false);
    $contadora = 0;
    $nVeces = 0;
    $inStudents  = false;
    $getDescription  =false;
    foreach($array as $row){
        //el funcionamiento de este es bajando de fila en fila por ello es necesario poner un contador para crear los diferente grupos
        if($contadora ==12 && $nVeces==0){
            $contadora=0;
            $nVeces=1;
        }else if($contadora==9 && $nVeces!=0){
            $contadora=0;
        }else{
            $contadora++;
            switch($row[0]){
                case "NIVEL":
                    $nivel = $row[1];
                    //vamos a buscar el nivel primero para poder ingresar los demás datos
                    $creado = $query->isALevelCreated($nivel);
                    //vemos si tenemos un nivel con ese nombre y sino es así lo guardamo
                    if(empty($creado)){
                        $query->saveNivel($nivel);
                        $creado = $query->isALevelCreated($nivel);
                        $idNivel = $creado['idnivel'];
                    }else{
                        //si ya existe solo sacamos el id de ese nivel para más pronto
                        $idNivel = $creado['idnivel'];
                    }
                break;
                case "GRADO:":
                    //vamos a insertar el grado de todos los proyectos
                     $grado = $row[1];
                    $seccion = $row[3];
                     //luego debemos verificar si existe un grado con este nombre  si no pues debemos insertarlo
                    $gradocreado = $query->isAGradeCreated($idNivel, $grado, $seccion);
                    if(empty($gradocreado)){
                        //vamos a guardar el grado
                       $query->saveGrado($grado, $seccion, $idNivel);
                       //luego lo volvemos a buscar para que este nos regrese su id
                       $gradocreado = $query->isAGradeCreated($idNivel, $grado, $seccion);
                       //definimos el id y tenemos listo
                       $idGrado = $gradocreado['idgrado'];
                    }else{
                        $idGrado = $gradocreado['idgrado'];
                    }
                break;
                 case  "MATERIA:":
                    $materia = $row[1];
                    //verificar los datos a igual que el anterior
                    $materias = $query->isASubjectSaved($materia);
                    if(empty($materias)){
                        $query->saveMateria($materia);
                        $materias = $query->isASubjectSaved($materia);
                        $idMateria = $materias['idmateria'];
                    }else{
                        $idMateria = $materias['idmateria'];
                    }
                break;
                case "NOMBRE DEL PROYECTO:":
                    $proyecto = $row[1];
                    if($proyecto != "ingrese el nombre aquí"){
                        echo($proyecto . "<br>");
                    }
                   $getDescription= true;
                
                break;
                case "CÓDIGO ESTUDIANTE":
                     //comenzamos a ver todos los código de estudiantes 
                    $inStudents=true;
                break;
                default:
                    if($getDescription==true){
                        $getDescription= false;
                        if($row[0]!="ingrese la descripción aquí"){
                            $exist = $query->findPorjectbyNGM($proyecto, $idGrado, $idMateria);
                            if(empty($exist)){
                                $query->saveProjects($proyecto, $row[0], $idGrado, $idMateria);
                                $exist = $query->findPorjectbyNGM($proyecto, $idGrado, $idMateria);
                                $idproyecto  = $exist['idproyecto'];
                            }else{
                                $idproyecto  = $exist['idproyecto'];
                            }
                        }
                    }
                    if($inStudents==true){
                        if($row[0]==""  ){
                            $inStudents=false;
                            echo("<br>");
                        }else{
                        //aquí podemos guardar estudiantes de manera sencilla 0 = codigo , 1= apellidos, 2= Nombres
                            $codigo = $row[0];
                            $apellidos =  $row[1];
                            $nombres =  $row[2];
                            $estudiantes = $query->findStudent($codigo);
                            if($estudiantes['COUNT(*)']==0){
                                $query-> saveStudent($codigo, $nombres, $apellidos, $idGrado);
                            }
                            $equipocreado = $query->equipoExiste($codigo, $idproyecto);
                            if($equipocreado['COUNT(*)']==0){
                                $query-> saveTeam($codigo, $idproyecto);
                            }
                        }
                  }
                break;
            }
         
        }
    }
    

?>