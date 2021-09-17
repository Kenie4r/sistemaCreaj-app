<?php
require_once('../modelo/conection.php');
require_once('../modelo/query.php');
require('../FPDF/fpdf.php');

//Función si no hay datos
function emptyEvaluacionProyecto(){
    //Se crea el PDF
    $pdf = new FPDF('L');
    //Se asigna el titulo
    $pdf->SetTitle("Sistema de Calificación de Crea J", true);
    $pdf->SetSubject("Sistema de Calificación de Crea J", true);
    //Se añade una nueva página
    $pdf->AddPage();

    //ENCABEZADO: EVALUACIONES
    $pdf->SetFont('Arial','B',15); //Fuente Negrita
    $pdf->Cell(0,10,utf8_decode("No se ha seleccionado ningún proyecto."), 0, 2, 'C'); //Titulo
    $pdf->Ln(); //Salto de línea

    //Obtener nombre del evento para el pdf
    $nombre = "vacio.pdf";
    //Escribir información
    $pdf->Output("I", $nombre, true);
}

//Función si no hay datos
function infoProyecto($idproyecto){
    //Se crea el PDF
    $pdf = new FPDF('L');
    //Se asigna el titulo
    $pdf->SetTitle("Sistema de Calificación de Crea J", true);
    $pdf->SetSubject("Sistema de Calificación de Crea J", true);
    //Se añade una nueva página
    $pdf->AddPage();

    //-----     Creación de consultas     -----
    $consulta = new Query; //Crear una consulta
    $teamData = $consulta->getTeamData($idproyecto); //Obtenemos los datos del proyecto
    //Generamos un apartado por proyecto
    foreach($teamData as $campo){
        //-----     TABLA: PROYECTO     -----
        //Variables de proyecto
        $nombreProyecto = $campo['nombreProyecto']; //Nombre
        $gradoProyecto = $campo['nombre'] ." " . $campo['seccion']; //Grado
        $materiaProyecto = $campo['nombreMateria']; //Materia
        $descripcionProyecto = $campo['descripcion']; //Descripción
        $notaFinalProyecto = $consulta->getRankingbyID($idproyecto); //Promedio final

        //Cuerpo de la tabla proyecto
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Proyecto:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($nombreProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Grado:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($gradoProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Materia:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($materiaProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Descripción:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0,10,utf8_decode($descripcionProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Estudiantes:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal

        //Variables de proyecto
        $equipoData = $consulta-> obtainTeamMates($idproyecto); //Obtener los nombres de los estudiantes
        
        //Estudiantes del proyecto
        foreach ($equipoData as $key => $estudiante) {
            $nombreEstudiante = $estudiante['idestudiante']." ".$estudiante['apellidos'];
            $pdf->Cell(0,10,utf8_decode($nombreEstudiante), "LR", 1, 'L'); //Contenido
        }

        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("No se ha calificado este proyecto..."), 1, 1, 'L'); //Clave
    }

    //Obtener nombre del evento para el pdf
    $nombrePDF = "Evaluacion_Proyecto_" . $nombreProyecto . ".pdf";
    //Escribir información
    $pdf->Output("I", $nombrePDF, true);
}

//Función para imprimir pdf con la evaluacion de un proyecto
function evaluacionProyecto($idproyecto){
    //-----     CREACIÓN DEL PDF     -----
    $pdf = new FPDF('L');
    //Se asigna el titulo
    $pdf->SetTitle("Sistema de Calificación de Crea J", true);
    $pdf->SetSubject("Sistema de Calificación de Crea J", true);
    $pdf->AddPage(); //Se añade una nueva página

    //-----     Creación de consultas     -----
    $consulta = new Query; //Crear una consulta
    $teamData = $consulta->getTeamData($idproyecto); //Obtenemos los datos del proyecto
    //Generamos un apartado por proyecto
    foreach($teamData as $campo){
        //-----     TABLA: PROYECTO     -----
        //Variables de proyecto
        $nombreProyecto = $campo['nombreProyecto']; //Nombre
        $gradoProyecto = $campo['nombre'] ." " . $campo['seccion']; //Grado
        $materiaProyecto = $campo['nombreMateria']; //Materia
        $descripcionProyecto = $campo['descripcion']; //Descripción
        $notaFinalProyecto = $consulta->getRankingbyID($idproyecto); //Promedio final
        //Dependiendo de que tan largo sea la materia se asignará un espacio espacial para esa fila
        if(strlen($materiaProyecto) > 21 || strlen($gradoProyecto) > 21){
            $alturaCelda = 20;
        }else{
            $alturaCelda = 10;
        }

        //Cuerpo de la tabla proyecto
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Proyecto:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($nombreProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Grado:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($gradoProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Materia:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0, 10,utf8_decode($materiaProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Descripción:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->MultiCell(0,10,utf8_decode($descripcionProyecto), 1, 'L'); //Contenido
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(0,10,utf8_decode("Estudiantes:"), 1, 1, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal

        //Variables de proyecto
        $equipoData = $consulta-> obtainTeamMates($idproyecto); //Obtener los nombres de los estudiantes
        
        //Estudiantes del proyecto
        foreach ($equipoData as $key => $estudiante) {
            $nombreEstudiante = $estudiante['idestudiante']." ".$estudiante['apellidos'];
            $pdf->Cell(0,10,utf8_decode($nombreEstudiante), "LR", 1, 'L'); //Contenido
        }
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(250,10,utf8_decode("Nota promedio obtenida:"), 1, 0, 'L'); //Clave
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->Cell(27,10,utf8_decode($notaFinalProyecto['notafinal']), 1, 1, 'R'); //Contenido

        //Variables de proyecto
        $jurados = $consulta->getProjectsRateData($idproyecto); //Obtener los jurados del proyecto
        $i = 0;

        //-----     TABLA: EVALUACIONES     -----
        //Generamos una tabla por jurado del proyecto
        foreach($jurados as $jury){
            //Variables de evaluaciones
            $infoPersonal  = $consulta->getUserById($jury['usuario_idUsuario']); //Obtenemos los datos del jurado
            $nombreJuradoActual = "Jurado: " . $infoPersonal['apellidos'] . ", " . $infoPersonal['nombres']; //Generamos el nombre del jurado

            $pdf->AddPage(); //Se añade una nueva página

            //Si es la primera página de evaluación, aparecera un titulo
            if($i == 0){
                //ENCABEZADO: EVALUACIONES
                $pdf->SetFont('Arial','B',15); //Fuente Negrita
                $pdf->Cell(0,10,utf8_decode("Evaluaciones de jurados"), 0, 2, 'C'); //Titulo
                $pdf->Ln(); //Salto de línea
                $i++; //El controlador de número de evaluación es "i"
            }

            //Encabezado de la tabla de evaluaciones
            $pdf->SetFont('Arial','B',15); //Fuente Negrita
            $pdf->Cell(0,10,utf8_decode($nombreJuradoActual), 1, 1, 'C'); //nombre del jurado

            //Variables de evaluaciones
            $criteriosC = $consulta->getPointsbyUserandTeam($jury['usuario_idUsuario'], $idproyecto); //Obtenemos los criterios de la rubrica del proyecto, y el puntaje colocado por este jurado
            $j = 0;

            //-----     TABLA: CRITERIOS     -----
            //Generamos una tabla por cada criterio
            foreach($criteriosC as $criterio) { 
                //Variables de criterio
                $criterioInfo = $consulta->getCriterioByID($criterio['criterios_idcriterios']); //Obtenemos la información del criterio
                $nombreCriterio = $criterioInfo['titulo']; //Nombre
                $porcentajeCriterio = $criterioInfo['puntaje'] . "%"; //Porcentaje
                //Nivel de aprobación
                if($criterio['puntos']<=20){
                    $nivelCriterio = "Inicial receptivo";
                }else if($criterio['puntos']>20 && $criterio['puntos']<=30 ){
                    $nivelCriterio = "Básico";
                }else if($criterio['puntos']>30 && $criterio['puntos']<=40){
                    $nivelCriterio = "Autónomo";
                }else{   
                    $nivelCriterio = "Estratégico";
                }
                $notaObtenidoCriterio = round($criterio['puntos'], 2); //Puntaje obtenido
                $naprobacion = $consulta->getRange($criterio['criterios_idcriterios'], $nivelCriterio); //Obtenemos los datos del nivel de aprobación
                $descripcionNivel = $naprobacion['descripcion']; //Descripción del nivel
                $numeroCriterio = "Criterio N° " . ($j + 1); //Posición del criterio en la tabla
                $j++; //Controlador de n° criterios

                //Cuerpo de criterio
                $pdf->SetFont('Arial','B',15); //Fuente Negrita
                $pdf->Cell(250,10,utf8_decode($numeroCriterio), 1, 0, 'L');
                $pdf->Cell(27,10,utf8_decode($porcentajeCriterio), 1, 1, 'R');
                $pdf->SetFont('Arial','',15); //Fuente Normal
                $pdf->Cell(0,10,utf8_decode($nombreCriterio), 1, 1, 'L');
                $pdf->SetFont('Arial','B',15); //Fuente Negrita
                $pdf->Cell(60,10,utf8_decode("Descripción:"), "L", 0, 'L');
                $pdf->Cell(65,10,utf8_decode("Nivel de aprendizaje:"), 1, 0, 'L');
                $pdf->SetFont('Arial','',15); //Fuente Normal
                $pdf->Cell(65,10,utf8_decode($nivelCriterio), 1, 0, 'L');
                $pdf->SetFont('Arial','B',15); //Fuente Negrita
                $pdf->Cell(62,10,utf8_decode("Puntaje obtenido:"), 1, 0, 'L');
                $pdf->SetFont('Arial','',15); //Fuente Normal
                $pdf->Cell(0,10,utf8_decode($notaObtenidoCriterio), 1, 1, 'R');
                $pdf->MultiCell(0,10,utf8_decode($descripcionNivel), "LRB", 'L');
            }

        }
    }

    //Obtener nombre del evento para el pdf
    $nombrePDF = "Evaluacion_Proyecto_" . $nombreProyecto . ".pdf";
    //Escribir información
    $pdf->Output("I", $nombrePDF, true);
}

?>