<?php
    require('../../FPDF/fpdf.php');
    require('../../modelo/conection.php');
    require('../../modelo/query.php');


    //creación del pdf de el ranking de un grado y materia

    //instancia de FPDF
    $fpdf = new FPDF();
    //definicion de nombre
    $fpdf->SetTitle("Sistema de Calificación de Crea J | Ranking", true);
    $fpdf->SetSubject("Sistema de Calificación de Crea J| Ranking", true);
    //se define el estilo de la fuente
    $fpdf->SetFont('Arial','BI' ,14);
    //se agregra una página donde podemos descargar todos los 
    $fpdf->AddPage('landscape', 'letter');
    //creación del documento 
    $fpdf->Cell(30, 10, "Puesto",1,0, 'c');
    $fpdf->Cell(75, 10, "Nombre del proyecto", 1,0, 'c');
    $fpdf->Cell(75, 10 , "Puntos obtenidos", 1,0, 'c');
    $fpdf->Cell(30, 10 , "Grado", 1,0, 'c');
    $fpdf->Cell(30,10, utf8_decode("Sección"), 1, 1, 'c');

    $fpdf->Cell(20, 10, "a", 1, 'c');
    $fpdf->SetFont('Arial','' ,12);
//finalización del documento
    $fpdf->Output();
?>