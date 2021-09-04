<?php
require_once('../../../modelo_general/bddconnect.php');
require_once('../modelo/consulta.php');
require_once('../../../controlador_general/login.php');
require('../../../recursos_login/FPDF/fpdf.php');
//Consulta
$consulta01 = new Consulta();
if(isset($_GET['id'])){
    //Extraer colaboradores
    $colaboradores = $consulta01->mostrarTodoColabEvento($_GET['id']);
    //Crear nueva clase
    class PDF extends FPDF{
        // Cabecera de página
        function Header(){
            $this->Image('../../../img/logo.png',5,5,60);
            // Titulo
            $this->SetFont('Arial','B',15);
            $this->Cell(230);
            $this->Cell(30,10,utf8_decode("Trabajo Social"));
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
            $this->SetFont('Arial','B',15);
            $this->Cell(0,10,utf8_decode($_GET['name']), 1, 1, 'C');
            //Introducción de la tabla
            $this->SetFont('Arial','B',15);
            $this->Cell(14,10,utf8_decode("N°"), 1, 0, 'C');
            $this->Cell(110,10,utf8_decode("Nombre del estudiante"), 1, 0, 'L');
            $this->Cell(33,10,utf8_decode("Grado"), 1, 0, 'C');
            $this->Cell(30,10,utf8_decode("Sección"), 1, 0, 'C');
            $this->Cell(30,10,utf8_decode("Turno"), 1, 0, 'C');
            $this->Cell(60,10,utf8_decode("Asistencia"), 1, 1, 'C');
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
    //Se crea la hoja
    $pdf = new PDF('L');
    //Se asigna el titulo
    $pdf->SetTitle("Trabajo Social", true);
    $pdf->SetSubject("Trabajo Social", true);
    //Se crea el número de página
    $pdf->AliasNbPages();
    //Se añade una nueva página
    $pdf->AddPage();
    //Llenar tabla
    $a = 1;
    for($i = 0; $i < count($colaboradores); $i++){
        $pdf->SetFont('Arial','',15);
        $pdf->Cell(14,10, $a, 1, 0, 'C');
        $pdf->Cell(110,10,utf8_decode($colaboradores[$i]['Nombre_Encargado']), 1, 0, 'L');
        $pdf->Cell(33,10,utf8_decode($colaboradores[$i]['Grado']), 1, 0, 'C');
        $pdf->Cell(30,10,utf8_decode($colaboradores[$i]['Seccion']), 1, 0, 'C');
        $pdf->Cell(30,10,utf8_decode($colaboradores[$i]['Turno']), 1, 0, 'C');
        $pdf->Cell(60,10,"", 1, 1, 'C');
        $a++;
    }
    //Obtener nombre del evento para el pdf
    $nombre = $_GET['name'] . ".pdf";
    //Escribir información
    $pdf->Output("I", $nombre, true);
}else{
    //Se niega el acceso para quienes no deben estar aqui
    $url = BASE_URL . "../inicio.php";
    header("Location: $url");
}
?>