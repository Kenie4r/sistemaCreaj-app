<?php
    $inputfile = "base _practica.xlsx";
    require 'composer/vendor/autoload.php';

    //comienzo de código 
    //definicion de la propiedad para leer el archivo
   $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
   //Identificamos el tipo de archivo que vamos a recibir
   $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputfile);
    
   //vamos a comenzar a leer el archivo 
   $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
   //obtenemos nuestro excel
   $spreadsheet = $reader->load($inputfile);
    //vamos a obtener todos los datos de nuestra hoja de excel
    $array = $spreadsheet->getActiveSheet()->toArray();
    $contadora = 0;
    $nVeces = 0;
    $inStudents  = false;
    foreach($array as $row){
        //el funcionamiento de este es bajando de fila en fila por ello es necesario poner un contador para crear los diferente grupos
        if($contadora ==12 && $nVeces==0){
            $contadora=0;
            $nVeces=1;
        }else if($contadora==9 && $nVeces!=0){
            $contadora=0;
        }else{
            $contadora++;
             if($row[0]=="GRADO:"){
                    //vamos a insertar el grado de todos los proyectos
                    $grado = $row[1];
                    $seccion = $row[3];
                    //luego debemos verificar si existe un grado con este nombre  si no pues debemos insertarlo
             }
             if($row[0]=="MATERIA:"){
                $materia = $row[1];
                //verificar los datos
             }
            if($row[0]== "NOMBRE DEL PROYECTO:"){
                $proyecto = $row[1];
             }
            //todos los que están abajo son estudiantes
            if($row[0]=="CÓDIGO ESTUDIANTE"){
                //comenzamos a ver todos los código de estudiantes 
                $inStudents=true;
            }else{
                if($inStudents==true){
                    if($row[0]==""  ){
                        $inStudents=false;
                    }else{
                        //aquí podemos guardar estudiantes de manera sencilla 0 = codigo , 1= apellidos, 2= Nombres
                    }
    
                }
            }
         
        }
    }

?>