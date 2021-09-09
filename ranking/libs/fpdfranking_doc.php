<?php

    require('pdfranking.php');
    require('../../modelo/conection.php');
    require('../../modelo/query.php');
//instancia de query
$query = new Query();

    //creación del pdf de el ranking de un grado y materia
//id ge materia 
$idGrado = $_GET['idGrado'];
$idMateria = $_GET['idMateria'];
$materiaInfo = $query->getMatterById($idMateria);
$gradoinfo = $query-> getGradobyID($idGrado);
    //instancia de FPDF
    $fpdf = new PDFR('L');
    //definicion de nombre
    $fpdf->SetTitle("Sistema de Calificación de Crea J | Ranking", true);
    $fpdf->SetSubject("Sistema de Calificación de Crea J| Ranking", true);
    //se define el estilo de la fuente
    
    $fpdf->SetFont('Arial','BI' ,14);
    //se agregra una página donde podemos descargar todos los 
    $fpdf->AddPage('landscape');
    $fpdf->setX(25);
    $fpdf->Cell(250,10, "Ranking de {$gradoinfo['nombre']}  {$gradoinfo['seccion']} y {$materiaInfo['nombre']}  ",0,1,'C');
    $fpdf->SetFont('Arial','' ,14);
    $fpdf->setX(35);
    $fpdf->Cell(250,10, "Se mostraran todos los proyectos del grado seleccionado en orden descendente al puntaje promedio entre los jurados",0,1,'C');
    //creación del documento 
    
//creación de los datos 
    $proyectos = $query->getRankingDESC($idGrado, $idMateria);
    $c = 1;
    foreach($proyectos as $camps){

        $jurados = $query->getProjectsRateData($camps['proyecto_idproyecto']);
        $proyectoInfo =$query->getTeambyID($camps['proyecto_idproyecto']);
        $fpdf->Cell(30,10, $c . utf8_decode("°"), 1,0,'c');
        $fpdf->Cell(200,10,utf8_decode("Nombre del proyecto es: " . $proyectoInfo['nombreProyecto']), 1, 0,'c');
        $fpdf->Cell(50,10, "Gano : " .$camps['notafinal'] . " Puntos",1,1,'c');
        $c++;

        foreach($jurados as $camp){
            $dataUser = $query->getUserById($camp['usuario_idUsuario']);
                $fpdf->cell(30,10,'#', 1,0, 'C');
                $fpdf->Cell(250,10,utf8_decode("El usuario : {$dataUser['nombres']} {$dataUser['apellidos']} califico este proyecto con:  {$camp['puntaje']} puntos. " ),1,1,'c');
            
            //$txtJurados .= "El Jurado " .$camp['usuario_idUsuario'] . " entrego ". $camp['puntaje']. "PUNTOS";
        }
        //$fpdf->MultiCell(80, 25, $txtJurados, 'LRTB', 'T', false);
        $fpdf->Ln(5);
    }
    //finalización del documento
    $nombre = "Ranking.pdf";
    //Escribir información
    $fpdf->Output("I", $nombre, true);
?>