<?php
require_once('../modelo/conection.php');
require_once('../modelo/query.php');
require('evaluacionProyecto.php');
//require('../controlador/pdfListJury.php');

//Consulta
$consulta = new Query; //Crear una consulta
//$jurados = $consulta->getJurys(); //Obtener jurados

//Variables
$nombreProyecto = "Creacion de PDF";
$gradoProyecto = "Tercer Año B";
$materiaProyecto = "Aplicaciones Web";
$descripcionProyecto = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur dolore, quidem hic debitis repudiandae nihil fugit modi. Suscipit eius, ipsam nisi eum quam laudantium hic sapiente cupiditate quia iste provident.";
$estudiantesProyecto = ["Diego Mancía", "Keneth Hernández", "Fernando Lemus", "José Novoa", "Jesús Novoa"];
$notaFinalProyecto = 80;

//Se crea la hoja
$pdf = new PDFEP('L');
//Se asigna el titulo
$pdf->SetTitle("Sistema de Calificación de Crea J", true);
$pdf->SetSubject("Sistema de Calificación de Crea J", true);
//Se añade una nueva página
$pdf->AddPage();

//Se restablecen las líneas
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0);
//Titulo
$pdf->SetFont('Arial','B',15);
$pdf->Cell(150,10,utf8_decode("Proyecto:"), 1, 0, 'L'); //190
$pdf->Cell(62,10,utf8_decode("Grado:"), 1, 0, 'L');
$pdf->Cell(65,10,utf8_decode("Materia:"), 1, 1, 'L');
$pdf->SetFont('Arial','',15);
$pdf->Cell(150,10,utf8_decode($nombreProyecto), 1, 0, 'L');
$pdf->Cell(62,10,utf8_decode($gradoProyecto), 1, 0, 'L');
$pdf->Cell(65,10,utf8_decode($materiaProyecto), 1, 1, 'L');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,utf8_decode("Descripción:"), 1, 1, 'L');
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,10,utf8_decode($descripcionProyecto), 1, 'L');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,utf8_decode("Estudiantes:"), 1, 1, 'L');
$pdf->SetFont('Arial','',15);
foreach ($estudiantesProyecto as $key => $estudiante) {
    $pdf->Cell(0,10,utf8_decode($estudiante), "LR", 1, 'L');
}
$pdf->SetFont('Arial','B',15);
$pdf->Cell(250,10,utf8_decode("Nota final obtenida:"), 1, 0, 'L');
$pdf->SetFont('Arial','',15);
$pdf->Cell(27,10,utf8_decode($notaFinalProyecto), 1, 1, 'R');
//Se añade una nueva página
$pdf->AddPage();

//Introducción de la tabla
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,utf8_decode("Evaluaciones"), 0, 2, 'C');
$pdf->Ln();
$pdf->Cell(0,10,utf8_decode("Jurado: Diego Mancía"), 1, 1, 'C');
$pdf->Cell(250,10,utf8_decode("Criterio 1"), 1, 0, 'L');
$pdf->Cell(27,10,utf8_decode("90%"), 1, 1, 'R');
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,10,utf8_decode("Puede crear PDF"), 1, 1, 'L');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(65,10,utf8_decode("Nivel de aprendizaje:"), 1, 0, 'L');
$pdf->Cell(150,10,utf8_decode("Descripción:"), 1, 0, 'L');
$pdf->Cell(62,10,utf8_decode("Puntaje obtenido:"), 1, 1, 'L');
$pdf->SetFont('Arial','',15);
$pdf->Cell(65,10,utf8_decode("Básico"), 1, 0, 'L');
$pdf->Cell(150,10,utf8_decode("Lorem ipsum dolor sit amet consectetur adipisicing elit"), 1, 0, 'L');
$pdf->Cell(62,10,utf8_decode("60.0"), 1, 1, 'L');


//Obtener nombre del evento para el pdf
$nombre = "Evaluacion_Proyecto.pdf";
//Escribir información
$pdf->Output("I", $nombre, true);
?>