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

    //-----     Creación de consultas     -----
    $consulta = new Query; //Crear una consulta
    $datosRank = $consulta->getRankingDESC($grado, $materia); //obtener el ranking completo 

    //Los 3 primeros proyectos
    for ($i=0; $i < 3; $i++) { 
        $idproyecto = $datosRank[$i]["proyecto_idproyecto"]; //Obtener el id proyecto a partir del ranking
        $teamData = $consulta->getTeamData($idproyecto); //Obtenemos los datos del proyecto

        //Generamos un apartado por proyecto
        foreach($teamData as $campo){
            //-----     TABLA: PROYECTO     -----
            $pdf->AddPage(); //Se añade una nueva página
            //Variables de proyecto
            $nombreProyecto = $campo['nombreProyecto']; //Nombre
            $gradoProyecto = $campo['nombre'] ." " . $campo['seccion']; //Grado
            $materiaProyecto = $campo['nombreMateria']; //Materia
            $descripcionProyecto = $campo['descripcion']; //Descripción
            $notaFinalProyecto = $consulta->getRankingbyID($idproyecto); //Promedio final

            $lugarProyecto = $i + 1 . "° Lugar";

            //Cuerpo de la tabla proyecto
            $pdf->SetFont('Arial','B',30); //Fuente Negrita
            $pdf->Cell(0,10,utf8_decode($lugarProyecto), 1, 1, 'C'); //Clave
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
            $pdf->Cell(27,10,utf8_decode($notaFinalProyecto['notafinal']), 1, 2, 'R'); //Contenido
        }
    }

    //Obtener nombre del evento para el pdf
    $nombrePDF = "Evaluacion_Proyecto_" . $nombreProyecto . ".pdf";
    //Escribir información
    $pdf->Output("I", $nombrePDF, true);
}

?>