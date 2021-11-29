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
         switch($row[0]){
                case "NIVEL":
                    $nivel = $row[1];
                    //vamos a buscar el nivel primero para poder ingresar los demás datos
                    $creado = $query->isALevelCreated($nivel);
                    $nivel = ucfirst($nivel);
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
                    
                    switch($grado){
                        case "III":
                        case "III año":
                        case "IIIaño":
                        case "3° año":
                        case "3°año":
                        case "3año":
                        case "3 año":
                            $grado = "Tercer año";
                        break;
                        case "II":
                        case "IIaño":
                        case"II año":
                        case  "2° año":
                        case  "2°año":
                        case "2año":
                        case "2 año":
                            $grado = "Segundo año";
                        break;
                        case "I":
                        case "Iaño":
                        case "I año" :
                        case "1° año":
                        case "1°año": 
                        case "1año":
                        case "1 año":
                            $grado = "Primer  año";
                        break;
                        case "1°":
                        case "primero":
                        case "Primero":
                        case "1":
                            $grado = "Primer grado";
                            break;
                        case "2° ":
                        case  "Segundo":
                        case "segundo":
                        case "2":
                            $grado = "Sergundo grado";
                            break;
                        case "3°":
                        case "Tercero":
                        case  "tercero":
                        case "3":
                            $grado = "Tercer grado";
                            break;
                        case "4°" :
                        case "cuarto":
                        case "Cuarto":
                        case "4":
                            $grado = "Cuarto grado";
                            break;
                        case "5°":
                        case "Quinto":
                        case "quinto":
                        case "5":
                            $grado  ="Quinto grado";
                            break;
                        case "6°":
                        case "sexto":
                        case "Sexto":
                        case "6":
                            $grado = "Sexto grado";
                            break;
                        case "7°":
                        case "Septimo":
                        case "septimo":
                        case "7":
                            $grado = "Septimo grado";
                            break;
                        case "8°":
                        case "octavo":
                        case "Octavo":
                        case "8":
                            $grado = "Octavo grado";
                            break;
                        case "9°":
                        case "Noveno":
                        case "noveno":
                        case "9":
                            $grado = "Noveno grado";
                            break;
                    }
                    $grado = ucfirst($grado);

                     //luego debemos verificar si existe un grado con este nombre  si no pues debemos insertarlo
                    $gradocreado = $query->isAGradeCreated($idNivel, $grado);
                    if(empty($gradocreado)){
                        //vamos a guardar el grado
                       $query->saveGrado($grado, $idNivel);
                       //luego lo volvemos a buscar para que este nos regrese su id
                       $gradocreado = $query->isAGradeCreated($idNivel, $grado);
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
                    switch($materia){
                        case "Matematicas":
                        case "Matemáticas":
                        case "matematicas":
                        case "matemáticas":
                            $materia = "Matemáticas";
                        break;
                    }
                    $materia = ucfirst($materia);
                    if(empty($materias)){
                        $query->saveMateria($materia);
                        $materias = $query->isASubjectSaved($materia);
                        $idMateria = $materias['idmateria'];
                    }else{
                        $idMateria = $materias['idmateria'];
                    }
                break;
                case "NOMBRE DEL PROYECTO:":
                    if($row[1]!= "ingrese el nombre aquí"){
                        $proyecto = $row[1];
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
                            if(is_numeric($codigo)){
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
                  }
                break;
            }
         
        }
    header('Location: index.php');
    

?>