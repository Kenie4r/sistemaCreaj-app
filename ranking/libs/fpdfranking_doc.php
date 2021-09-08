<?php
    require('../../FPDF/fpdf.php');
    require('../../modelo/conection.php');
    require('../../modelo/query.php');

//instancia de query
$query = new Query();

    //creación del pdf de el ranking de un grado y materia
//id ge materia 
$idGrado = $_GET['idGrado'];
$idMateria = $_GET['idMateria'];

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
    $fpdf->Cell(85, 10, "Nombre del proyecto", 1,0, 'c');
    $fpdf->Cell(75, 10 , "Puntos obtenidos", 1,0, 'c');
    $fpdf->Cell(30, 10 , "Grado", 1,0, 'c');
    $fpdf->Cell(30,10, utf8_decode("Sección"), 1, 1, 'c');

    $fpdf->SetFont('Arial','' ,12);
//creación de los datos 
    $proyectos = $query->getRankingDESC($idGrado, $idMateria);
    $c = 1;
    foreach($proyectos as $camps){
        $proyectoInfo =$query->getTeambyID($camps['proyecto_idproyecto']);
        $fpdf->Cell(30,20, $c, 1,0,'c');
        $fpdf->Cell(85,20,utf8_decode($proyectoInfo['nombreProyecto']), 1, 0,'c');
        $fpdf->Cell(75, 20, $camps['notafinal'],1,0,'c');
        $c++;
        $fpdf->Ln(20);
    }
    //finalización del documento
    $fpdf->Output();
?>