<?php
require_once('../modelo/conection.php');
require_once('../modelo/query.php');
require('../FPDF/fpdf.php');

//Función si no hay datos
function emptyRankingProyecto(){
    //Se crea el PDF
    $pdf = new FPDF('L');
    //Se asigna el titulo
    $pdf->SetTitle("Sistema de Calificación de Crea J", true);
    $pdf->SetSubject("Sistema de Calificación de Crea J", true);
    //Se añade una nueva página
    $pdf->AddPage();

    //ENCABEZADO: EVALUACIONES
    $pdf->SetFont('Arial','B',15); //Fuente Negrita
    $pdf->Cell(0,10,utf8_decode("No hay proyectos calificados."), 0, 2, 'C'); //Titulo
    $pdf->Ln(); //Salto de línea

    //Obtener nombre del evento para el pdf
    $nombre = "vacio.pdf";
    //Escribir información
    $pdf->Output("I", $nombre, true);
}

//Función para imprimir pdf con la evaluacion de un proyecto
function rankingProyecto($materia, $grado){
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


    }

    //Obtener nombre del evento para el pdf
    $nombrePDF = "Evaluacion_Proyecto_" . $nombreProyecto . ".pdf";
    //Escribir información
    $pdf->Output("I", $nombrePDF, true);
}

?>