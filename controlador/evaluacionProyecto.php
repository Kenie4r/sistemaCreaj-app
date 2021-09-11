<?php
require('../FPDF/fpdf.php');

//PDF Evaluación Proyecto
//277
class PDFEP extends FPDF{
    // Cabecera de página
    /*function Header(){
        //Se restablecen las líneas
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0);
        //Titulo
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,utf8_decode("Proyecto"), 1, 1, 'C');
        //Introducción de la tabla
        $this->SetFont('Arial','B',15);
        $this->Cell(55,10,utf8_decode("Usuario"), 1, 0, 'C');
        $this->Cell(50,10,utf8_decode("Nombre"), 1, 0, 'C');
        $this->Cell(50,10,utf8_decode("Apellido"), 1, 0, 'C');
        $this->Cell(80,10,utf8_decode("Email"), 1, 0, 'C');
        $this->Cell(42,10,utf8_decode("Estado"), 1, 1, 'C');
    }*/
}

?>