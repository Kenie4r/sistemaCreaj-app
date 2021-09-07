<?php
require_once('../modelo/conection.php');
require_once('../modelo/query.php');
require('../controlador/pdfListJury.php');

//Consulta
$consulta = new Query; //Crear una consulta
$jurados = $consulta->getJurys(); //Obtener jurados

//Se crea la hoja
$pdf = new PDFLJ('L');
//Se asigna el titulo
$pdf->SetTitle("Sistema de Calificación de Crea J", true);
$pdf->SetSubject("Sistema de Calificación de Crea J", true);
//Se crea el número de página
$pdf->AliasNbPages();
//Se añade una nueva página
$pdf->AddPage();

//Llenar tabla
for($i = 0; $i < count($jurados); $i++){
    $pdf->SetFont('Arial','',15);
    $pdf->Cell(55,10,utf8_decode($jurados[$i]['usuario']), 1, 0, 'C');
    $pdf->Cell(50,10,utf8_decode($jurados[$i]['nombres']), 1, 0, 'C');
    $pdf->Cell(50,10,utf8_decode($jurados[$i]['apellidos']), 1, 0, 'C');
    $pdf->Cell(80,10,utf8_decode($jurados[$i]['email']), 1, 0, 'C');
    if($jurados[$i]['password'] == "6e8bf488a257263be3f2913f43dc7ddf"){
        $pdf->Cell(42,10,utf8_decode("Inactivo"), 1, 1, 'C');
    }else{
        $pdf->Cell(42,10,utf8_decode("Activo"), 1, 1, 'C');
    }
}
//Obtener nombre del evento para el pdf
$nombre = "Listado_Jurados.pdf";
//Escribir información
$pdf->Output("I", $nombre, true);
?>