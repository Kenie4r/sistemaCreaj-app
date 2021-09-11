<?php
require_once('../modelo/conection.php');
require_once('../modelo/query.php');
require('evaluacionProyecto.php');
//require('../controlador/pdfListJury.php');

//Consulta
$consulta = new Query; //Crear una consulta
//$jurados = $consulta->getJurys(); //Obtener datos proyectos
//Obtener datos rubrica
//Obtener notas obtenidas

//Variables
$nombreProyecto = "Creacion de PDF";
$gradoProyecto = "Tercer Año B";
$materiaProyecto = "Aplicaciones Web";
$descripcionProyecto = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur dolore, quidem hic debitis repudiandae nihil fugit modi. Suscipit eius, ipsam nisi eum quam laudantium hic sapiente cupiditate quia iste provident.";
$estudiantesProyecto = ["Diego Mancía", "Keneth Hernández", "Fernando Lemus", "José Novoa", "Jesús Novoa"];
$notaFinalProyecto = 80;

//Se crea el PDF
$pdf = new PDFEP('L');
//Se asigna el titulo
$pdf->SetTitle("Sistema de Calificación de Crea J", true);
$pdf->SetSubject("Sistema de Calificación de Crea J", true);
//Se añade una nueva página
$pdf->AddPage();

//TABLA: PROYECTO
$pdf->SetFont('Arial','B',15); //Fuente Negrita
$pdf->Cell(150,10,utf8_decode("Proyecto:"), 1, 0, 'L'); //Clave
$pdf->Cell(62,10,utf8_decode("Grado:"), 1, 0, 'L'); //Clave
$pdf->Cell(65,10,utf8_decode("Materia:"), 1, 1, 'L'); //Clave
$pdf->SetFont('Arial','',15); //Fuente Normal
$pdf->Cell(150,10,utf8_decode($nombreProyecto), 1, 0, 'L'); //Contenido
$pdf->Cell(62,10,utf8_decode($gradoProyecto), 1, 0, 'L'); //Contenido
$pdf->Cell(65,10,utf8_decode($materiaProyecto), 1, 1, 'L'); //Contenido
$pdf->SetFont('Arial','B',15); //Fuente Negrita
$pdf->Cell(0,10,utf8_decode("Descripción:"), 1, 1, 'L'); //Clave
$pdf->SetFont('Arial','',15); //Fuente Normal
$pdf->MultiCell(0,10,utf8_decode($descripcionProyecto), 1, 'L'); //Contenido
$pdf->SetFont('Arial','B',15); //Fuente Negrita
$pdf->Cell(0,10,utf8_decode("Estudiantes:"), 1, 1, 'L'); //Clave
$pdf->SetFont('Arial','',15); //Fuente Normal
//Lista estudiantes
foreach ($estudiantesProyecto as $key => $estudiante) {
    $pdf->Cell(0,10,utf8_decode($estudiante), "LR", 1, 'L'); //Contenido
}
$pdf->SetFont('Arial','B',15); //Fuente Negrita
$pdf->Cell(250,10,utf8_decode("Nota final obtenida:"), 1, 0, 'L'); //Clave
$pdf->SetFont('Arial','',15); //Fuente Normal
$pdf->Cell(27,10,utf8_decode($notaFinalProyecto), 1, 1, 'R'); //Contenido

//Se añade una nueva página
$pdf->AddPage();

//ENCABEZADO: EVALUACIONES
$pdf->SetFont('Arial','B',15); //Fuente Negrita
$pdf->Cell(0,10,utf8_decode("Evaluaciones"), 0, 2, 'C'); //Titulo
$pdf->Ln(); //Salto de línea

//TABLA: EVALUACIONES
for ($i=0; $i < 2; $i++) {
    $pdf->SetFont('Arial','B',15); //Fuente Negrita
    $pdf->Cell(0,10,utf8_decode("Jurado: Diego Mancía"), 1, 1, 'C'); //Jurado
    //Criterios de rubrica
    for ($j=0; $j < 2; $j++) { 
        //Variables
        $numeroCriterio = "Criterio N° " . ($j + 1);

        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(250,10,utf8_decode($numeroCriterio), 1, 0, 'L');
        $pdf->Cell(27,10,utf8_decode("90%"), 1, 1, 'R');
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->Cell(0,10,utf8_decode("Puede crear PDF"), 1, 1, 'L');
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(60,10,utf8_decode("Descripción:"), "L", 0, 'L');
        $pdf->Cell(65,10,utf8_decode("Nivel de aprendizaje:"), 1, 0, 'L');
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->Cell(65,10,utf8_decode("Básico"), 1, 0, 'L');
        $pdf->SetFont('Arial','B',15); //Fuente Negrita
        $pdf->Cell(62,10,utf8_decode("Puntaje obtenido:"), 1, 0, 'L');
        $pdf->SetFont('Arial','',15); //Fuente Normal
        $pdf->Cell(0,10,utf8_decode("60.0"), 1, 1, 'R');
        $pdf->MultiCell(0,10,utf8_decode("Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur dolore, quidem hic debitis repudiandae nihil fugit modi. Suscipit eius, ipsam nisi eum quam laudantium hic sapiente cupiditate quia iste provident."), "LRB", 'L');
    }

    //Se añade una nueva página
    $pdf->AddPage();
}

//Obtener nombre del evento para el pdf
$nombre = "Evaluacion_Proyecto.pdf";
//Escribir información
$pdf->Output("I", $nombre, true);
?>