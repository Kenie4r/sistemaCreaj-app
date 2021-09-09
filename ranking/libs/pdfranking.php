<?php
require('../../FPDF/fpdf.php');

class PDFR extends FPDF{
    // Cabecera de página
    function Header(){
        //$this->Image('../../../img/logo.png',5,5,60);
        // Titulo
        $this->SetFont('Arial','B',15);
        $this->Cell(190);
        $this->Cell(30,10,utf8_decode("Sistema de Calificación de Crea J"));
        // Salto de línea
        $this->Ln(30);
        //Linea 1
        $this->SetDrawColor(0, 0, 132);
        $this->SetLineWidth(2);
        $this->Line(0, 30, 300, 30);
        //Linea 2
        $this->SetDrawColor(255, 221, 0);
        $this->SetLineWidth(2);
        $this->Line(0, 32, 300, 32);
        //Se restablecen las líneas
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0);
        //Titulo

    }

    // Pie de página
    function Footer(){
        // Mensaje de motivación
        $this->SetY(-20);
        $this->Cell(215);
        $this->SetFont('Arial','I',8);
        $this->SetFillColor(200,220,255);
        $this->Cell(75,5,utf8_decode('"Honrados ciudadanos y buenos cristianos"'),0,0,'L', true);
        //Número de página
        $this->SetY(-15);
        $this->Cell(265);
        $this->SetFont('Arial','I',8);
        $this->SetFillColor(255, 221, 0);
        $this->Cell(25, 5, utf8_decode("N° Página ").$this->PageNo(), 0, 0,'L', true);
    }
}

?>